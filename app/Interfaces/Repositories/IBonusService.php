<?php


namespace App\Interfaces\Repositories;


use App\Models\AccountLoaylty;

interface IBonusService
{
    function initUserBonusAccount(int $userId, int $count): AccountLoaylty;
}
