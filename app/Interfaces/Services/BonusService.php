<?php


namespace App\Interfaces\Services;


use App\Interfaces\Repositories\IBonusRepository;
use App\Interfaces\Repositories\IBonusService;
use App\Models\AccountLoaylty;

/**
 * Сервис для работы с бонусной системой пользователей
 *
 * @package App\Interfaces\Services
 * @author Serdar Durdyev
 */
class BonusService implements IBonusService
{
    private IBonusRepository $bonusRepository;

    public function __construct(IBonusRepository $bonusRepository)
    {
        $this->bonusRepository = $bonusRepository;
    }

    /**
     * Инициализация данных бонусов лояльности пользователя
     *
     * @param int $userId Id пользователя, для которого мы создаем запись бонусов лояльности
     * @param int $count Количество баллов, инициируемых для пользователя
     * @return AccountLoaylty Запись о бонусных данных пользователя
     */
    function initUserBonusAccount(int $userId, int $count): AccountLoaylty
    {
        $existAccountUserLoyalty = $this->bonusRepository->getUserBonusInfoByUserId($userId);
        if (!$existAccountUserLoyalty) {
            return $this->bonusRepository->addUserBonus($userId, $count);
        }
        $this->bonusRepository->updateUserBonusInfo($existAccountUserLoyalty, $count);
        return $existAccountUserLoyalty;
    }
}
