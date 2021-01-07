<?php


namespace App\Services;


use App\Interfaces\Repositories\IRewardRepository;
use App\Interfaces\Repositories\ITypeRewardRepository;
use App\Interfaces\Services\IPrizeGeneratorService;
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

    public function __construct(IRewardRepository $rewardRepository, ITypeRewardRepository $typeRewardRepository)
    {
        $this->rewardRepository = $rewardRepository;
        $this->typeRewardRepository = $typeRewardRepository;
    }

    /**
     * Метод генерации приза случайном образом
     *
     * @return iterable Вернем список с результатами генерации
     * @throws \Exception Выбрасываем исключение в случае
     */
    public function generatePriceService(): iterable
    {
        $moneyTypeRewardId = 1;
        $itemTypeRewardId = 3;

        $randomTypeReward = $this->typeRewardRepository->generateRandom();
        if (!$randomTypeReward)
            throw new \Exception("Таблица type_rewards пустая, заполните таблицу", JsonResponse::HTTP_CONFLICT);

        $reward = $this->rewardRepository->getRewardByTypeRewardId($randomTypeReward->id);

        if ($reward) {
            $randomCount = rand(1, $reward->count);

            // Если был сгенерирован денежный приз, то отправляем по API
            if ($randomTypeReward->id == $moneyTypeRewardId) {

            }
        }
    }
}
