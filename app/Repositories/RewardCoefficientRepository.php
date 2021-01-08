<?php


namespace App\Repositories;


use App\Interfaces\Repositories\IRewardCoefficientRepository;
use App\Models\MoneyRewardCofficient;

/**
 * Репозиторий по работе с коэффициентами наград
 * @package App\Repositories
 */
class RewardCoefficientRepository implements IRewardCoefficientRepository
{
    /**
     * Получение данных коэффициента для наград
     * @param int $typeIdRewardFrom Для какой награды рассматриваем коэффициента
     * @param int $typeIdRewardTo Относительно какого типа награды рассматриваем
     * @return MoneyRewardCofficient|null Найдем запись из таблицы money_reward_cofficients или пустую запись
     */
    function getInfoAboutCoefficient(int $typeIdRewardFrom, int $typeIdRewardTo): ?MoneyRewardCofficient
    {
        return MoneyRewardCofficient::where([
            'type_reward_from_id' => $typeIdRewardFrom,
            'type_reward_to_id' => $typeIdRewardTo
        ])->first();
    }
}
