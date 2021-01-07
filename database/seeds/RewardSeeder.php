<?php

use Illuminate\Database\Seeder;

/**
 * Наполнитель для таблицы наград rewards
 * @author Serdar Durdyev
 */
class RewardSeeder extends Seeder
{
    /**
     * Для каждого типа наград устанавливаем ограничение количество наград,
     * где 1 или 3 в начале каждого массива это Id типа вознаграждения в таблице type_rewards
     * @var array|string[][]
     */
    protected array $rewards = [
        1 => ['Денежный приз' => 1000],
        3 => ['Косынка' => 33, 'Скутер' => 22, 'Кружка' => 45]
    ];

    /**
     * Логика запуска наполнителя
     * @throws Exception
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            foreach ($this->rewards as $idTypeReward => $arrayLimitsRewards) {
                $typeRewardExist = \App\Models\TypeReward::find($idTypeReward);

                if (!$typeRewardExist)
                    throw new Exception("Такого типа вознаграждения нет в базе");

                foreach ($arrayLimitsRewards as $nameReward => $count) {
                    \App\Models\Reward::create([
                        'id_type_reward' => $idTypeReward,
                        'name' => $nameReward,
                        'count' => $count
                    ]);
                }
            }
            \Illuminate\Support\Facades\DB::commit();
        } catch (\Exception $exception) {
            \Illuminate\Support\Facades\DB::rollBack();
            throw new Exception($exception);
        }
    }
}
