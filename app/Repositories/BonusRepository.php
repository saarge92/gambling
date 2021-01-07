<?php


namespace App\Repositories;


use App\Interfaces\Repositories\IBonusRepository;
use App\Models\AccountLoaylty;

/**
 * Репозиторий по работе с сущностью account_loyalties
 * @package App\Repositories
 * @author Serdar Durdyev≈
 */
class BonusRepository implements IBonusRepository
{
    /**
     * Добавление новых данных account_loyalties для пользователя,
     * чьи данные раннее добавлены не были
     * @param int $userId Id пользователя, чьи бонусные данные мы создаем
     * @param int $count Количество баллов пользователя
     * @return AccountLoaylty Созданная запись
     */
    public function addUserBonus(int $userId, int $count): AccountLoaylty
    {
        return AccountLoaylty::create([
            'user_id' => $userId,
            'points' => $count
        ]);
    }

    /**
     * @param int $userId
     * @return AccountLoaylty|null
     */
    public function getUserBonusInfoByUserId(int $userId): ?AccountLoaylty
    {
        return AccountLoaylty::where(['user_id' => $userId])->first();
    }

    function updateUserBonusInfo(AccountLoaylty $accountLoyalty, int $count)
    {
        $accountLoyalty->points = $accountLoyalty->points + $count;
        $accountLoyalty->update();
    }
}
