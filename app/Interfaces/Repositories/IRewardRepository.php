<?php


namespace App\Interfaces\Repositories;

use App\Models\Reward;

/**
 * Интерфейс, определяющий репозиторий по работе с сущностью "Награды"
 * @package App\Interfaces\Repositories
 * @author Serdar Durdyev
 */
interface IRewardRepository
{
    function getRewardByTypeRewardId(int $id): ?Reward;

    function withDrawalCount(Reward &$reward, int $count);

    function getRewardByTypeRewardIdRandomly(int $id): ?Reward;

    function getRewardById(int $id): ?Reward;
}
