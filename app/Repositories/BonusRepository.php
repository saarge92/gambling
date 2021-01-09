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
     * Получение информации о бонусных данных пользователя
     * @param int $userId Id пользователя, чей бонус мы ищем
     * @return AccountLoaylty|null Вернем найденную запись или пустую запись
     */
    public function getUserBonusInfoByUserId(int $userId): ?AccountLoaylty
    {
        return AccountLoaylty::where(['user_id' => $userId])->first();
    }

    /**
     * Обновление записи о бонусах пользователя
     * @param AccountLoaylty $accountLoyalty Данные записи бонуса
     * @param int $count Количество баллов/очков
     */
    public function updateUserBonusInfo(AccountLoaylty $accountLoyalty, int $count)
    {
        $accountLoyalty->points = $accountLoyalty->points + $count;
        $accountLoyalty->update();
    }

    /**
     * Установка количества баллов для аккаунта бонусов пользователя
     * @param AccountLoaylty $accountLoaylty Данные бонусов пользователя
     * @param int $count Количество устанавливаемых баллов
     */
    function setUserBonusCount(AccountLoaylty $accountLoaylty, int $count)
    {
        $accountLoaylty->points = $count;
        $accountLoaylty->update();
    }
}
