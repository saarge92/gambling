<?php


namespace App\Interfaces\Services;


interface IBonusMoneyExchangeService
{
    function exchangeBonusToMoney(int $userId, array $paymentInfo);
}
