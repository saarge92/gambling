<?php


namespace App\Interfaces\Repositories;

use App\Models\AccountLoaylty;

/**
 * Интерфейс, определяющий репозиторий для работы с сущностью account_loyalties
 *
 * @package App\Interfaces\Repositories
 * @author Serdar Durdyev
 */
interface IBonusRepository
{
    function addUserBonus(int $userId, int $count): AccountLoaylty;

    function getUserBonusInfoByUserId(int $userId): ?AccountLoaylty;

    function updateUserBonusInfo(AccountLoaylty $accountLoyalty, int $count);
}
