<?php


namespace App\Interfaces\Repositories;


use App\Models\AccountLoaylty;

/**
 * Сервис по работе с бонусной системой пользователя
 * @package App\Interfaces\Repositories
 */
interface IBonusService
{
    function initUserBonusAccount(int $userId, int $count): AccountLoaylty;

    function getUserBonusInfoByUserId(int $userId): ?AccountLoaylty;
}
