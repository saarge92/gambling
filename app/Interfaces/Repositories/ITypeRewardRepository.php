<?php


namespace App\Interfaces\Repositories;

use App\Models\TypeReward;

/**
 * Репозиторий по работе с типами наград в системе
 * @package App\Interfaces\Repositories
 * @author Serdar Durdyev
 */
interface ITypeRewardRepository
{
    function create(array $data): TypeReward;

    function generateRandom(): ?TypeReward;
}
