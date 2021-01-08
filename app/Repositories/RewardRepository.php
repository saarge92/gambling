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
     * Получение вознаграждения по id типу вознаграждения
     * @param int $id Id Id типа вознаграждения
     * @return Reward|null Вернет найденное награждение
     */
    public function getRewardByTypeRewardId(int $id): ?Reward
    {
        return Reward::where(['id_type_reward' => $id])->first();
    }

    /**
     * Изменение лимита на награду
     * @param Reward $reward Текущая награда
     * @param int $count Количество снимаемых наград
     */
    public function withDrawalCount(Reward &$reward, int $count)
    {
        $reward->count = $reward->count - $count;
        $reward->update();
    }

    public function getRewardByTypeRewardIdRandomly(int $id): ?Reward
    {
        return Reward::where(['id_type_reward' => $id])->orderByRaw("RAND()")->first();
    }

    public function getRewardById(int $id): ?Reward
    {
        return Reward::find($id);
    }
}
