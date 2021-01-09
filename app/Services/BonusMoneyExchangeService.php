<?php


namespace App\Services;

use App\Interfaces\Repositories\IBonusRepository;
use App\Interfaces\Repositories\IRewardCoefficientRepository;
use App\Interfaces\Services\IBonusMoneyExchangeService;
use App\Interfaces\Services\IStripeRemoteService;
use Illuminate\Http\JsonResponse;

/**
 * Сервис для работы с обменом бонусов на деньги
 * @package App\Services
 * @author Serdar Durdyev
 */
class BonusMoneyExchangeService implements IBonusMoneyExchangeService
{
    protected IBonusRepository $bonusRepository;
    protected IStripeRemoteService $stripeRemoteService;
    protected IRewardCoefficientRepository $rewardCoefficientRepository;

    public function __construct(IBonusRepository $bonusRepository, IStripeRemoteService $stripeRemoteService,
                                IRewardCoefficientRepository $coefficientRepository)
    {
        $this->bonusRepository = $bonusRepository;
        $this->stripeRemoteService = $stripeRemoteService;
        $this->rewardCoefficientRepository = $coefficientRepository;
    }

    /**
     * Обмениваем бонусы пользователя
     * @param int $userId Id пользователя, чьи данные мы хотим обменять
     * @param array $paymentInfo Данные платежной информации
     * @return array Вернем массив с данными
     * @throws \Exception
     */
    function exchangeBonusToMoney(int $userId, array $paymentInfo)
    {
        $bonusIdReward = 1;
        $moneyIdReward = 2;

        $accountLoyalty = $this->bonusRepository->getUserBonusInfoByUserId($userId);
        if (!$accountLoyalty)
            throw new \Exception("Баланс пользователя пуст", JsonResponse::HTTP_CONFLICT);

        if ($accountLoyalty->points <= 0)
            throw new \Exception("Баланс пользователя пуст", JsonResponse::HTTP_CONFLICT);

        $coefficientInfo = $this->rewardCoefficientRepository->getInfoAboutCoefficient($moneyIdReward, $bonusIdReward);
        if (!$coefficientInfo)
            throw new \Exception("Данных коэффициента по обмену отсутствует", JsonResponse::HTTP_CONFLICT);

        $this->stripeRemoteService->createToken($paymentInfo);
        $moneyWithdraw = $accountLoyalty->points * $coefficientInfo->coefficient;
        $this->bonusRepository->setUserBonusCount($accountLoyalty, 0);
        return [
            'account_loaylty' => $accountLoyalty,
            'money' => $moneyWithdraw
        ];
    }
}
