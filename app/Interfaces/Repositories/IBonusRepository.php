<?php


namespace App\Interfaces\Repositories;


use App\Models\AccountLoaylty;

interface IBonusRepository
{
    function addUserBonus(int $userId, int $count): AccountLoaylty;

    function getUserBonusInfoByUserId(int $userId): ?AccountLoaylty;

    function updateUserBonusInfo(AccountLoaylty $accountLoyalty, int $count);
}
