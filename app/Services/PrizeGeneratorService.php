<?php


namespace App\Services;


use App\Interfaces\Repositories\IRewardRepository;
use App\Interfaces\Repositories\ITypeRewardRepository;
use App\Interfaces\Services\IPrizeGeneratorService;
use App\Interfaces\Services\IStripeRemoteService;
use App\Models\Reward;
use App\Models\TypeReward;
use Illuminate\Http\JsonResponse;

/**
 * Сервис по генерации призов для пользователя
 * @package App\Services
 * @author Serdar Durdyev
 */
class PrizeGeneratorService implements IPrizeGeneratorService
{
    private ITypeRewardRepository $typeRewardRepository;
    private IRewardRepository $rewardRepository;
    private IStripeRemoteService $stripeRemoteService;

    public function __construct(IRewardRepository $rewardRepository, ITypeRewardRepository $typeRewardRepository,
                                IStripeRemoteService $stripeRemoteService)
    {
        $this->rewardRepository = $rewardRepository;
        $this->typeRewardRepository = $typeRewardRepository;
        $this->stripeRemoteService = $stripeRemoteService;
    }

    /**
     * Метод генерации приза случайном образом
     *
     * @return iterable Вернем список с результатами генерации
     * @throws \Exception Выбрасываем исключение в случае
     */
    public function generatePriceService(): iterable
    {
        $randomTypeReward = $this->typeRewardRepository->generateRandom();
        if (!$randomTypeReward)
            throw new \Exception("Таблица type_rewards пустая, заполните таблицу", JsonResponse::HTTP_CONFLICT);

        $reward = $this->rewardRepository->getRewardByTypeRewardId($randomTypeReward->id);
        if ($reward) {
            if ($reward->count <= 0)
                return [
                    'prize' => $randomTypeReward,
                    'count' => 0
                ];
            $count = rand(1, $reward->count);
            return [
                'prize' => $randomTypeReward,
                'count' => $count
            ];
        }
        return [
            'prize' => $randomTypeReward,
            'count' => rand(1, 100)
        ];
    }

    /**
     * Получение приза пользователем
     *
     * @param int $currentUserId Id текущего пользователя
     * @param int $typeRewardId Тип вознаграждения
     * @param array|null $paymentInfo Платежная информация в случае если мы хотим получить деньги
     * либо данные, указывающее на количество получаемых подарков
     *
     * @return array Вернем массив
     * @throws \Exception
     */
    public function getPrize(int $currentUserId, int $typeRewardId, ?array $paymentInfo): array
    {
        $typeReward = $this->typeRewardRepository->getById($typeRewardId);
        if (!$typeReward)
            throw new \Exception("Данный тип вознаграждения отсутствует", JsonResponse::HTTP_CONFLICT);

        $reward = $this->rewardRepository->getRewardByTypeRewardId($typeRewardId);
        return $this->initWithDrawReward($reward, $typeRewardId, $paymentInfo);
    }

    private function initWithDrawReward(?Reward $reward, TypeReward $typeReward, array $paymentInfo): array
    {
        $moneyTypeRewardId = 1;
        $bonusBallRewardId = 2;

        if ($reward) {
            $differenceAfterWithdrawal = $reward->count - $paymentInfo['count'];
            if ($differenceAfterWithdrawal < 0)
                throw new \Exception("Невозможно снять количество, превышающее лимит!", JsonResponse::HTTP_CONFLICT);

            switch ($typeReward->id) {
                case $moneyTypeRewardId:
                {
                    $this->stripeRemoteService->createToken($paymentInfo);
                    $this->rewardRepository->withDrawalCount($reward, $paymentInfo['count']);
                    return [
                        'type_reward_id' => $typeReward->id,
                        'name' => $typeReward->name,
                        'count' => $paymentInfo['count']
                    ];
                }
                case $bonusBallRewardId:
                {
                    $this->rewardRepository->withDrawalCount($reward, $paymentInfo['count']);

                }
            }
        }
    }
}
