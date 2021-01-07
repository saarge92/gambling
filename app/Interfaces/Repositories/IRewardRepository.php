<?php


namespace App\Interfaces\Repositories;

/**
 * Интерфейс, определяющий репозиторий по работе с сущностью "Награды"
 * @package App\Interfaces\Repositories
 * @author Serdar Durdyev
 */
interface IRewardRepository
{
    function getRewardByTypeRewardId(int $id);
}
