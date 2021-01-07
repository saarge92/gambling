<?php

use Illuminate\Database\Seeder;

/**
 * Наполнитель для таблицы type_rewards
 * @author Serdar Durdyev
 */
class TypeRewardSeeder extends Seeder
{
    private array $rewards = [1 => 'Денежный приз', 2 => 'Бонусные баллы', 3 => 'Физический предмет'];


    /**
     * Процесс исполнения метода
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->rewards as $reward) {
            \App\Models\TypeReward::create([
                'name' => $reward
            ]);
        }
    }
}
