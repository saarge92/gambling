<?php


namespace App\Interfaces\Repositories;


use App\Models\MoneyRewardCofficient;

interface IRewardCoefficientRepository
{
    function getInfoAboutCoefficient(int $typeIdRewardFrom, int $typeIdRewardTo): ?MoneyRewardCofficient;
}
