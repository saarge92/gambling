<?php


namespace App\Repositories;


use App\Interfaces\Repositories\IRewardRepository;
use App\Models\Reward;

/**
 * Репозиторий по работе с таблицей rewards
 * @package App\Repositories
 * @author Serdar Durdyev
 */
class RewardRepository implements IRewardRepository
{
    /**
     * Получение вознаграждения по id
     * @param int $id Id
     * @return mixed
     */
    public function getRewardByTypeRewardId(int $id): ?Reward
    {
        return Reward::find($id);
    }


    function withDrawalCount(Reward &$reward, int $count)
    {
        $reward->count = $reward->count - $count;
        $reward->update();
    }
}
