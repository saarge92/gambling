<?php

use Illuminate\Database\Seeder;

/**
 * Наполнитель для соотношения коээфициентов
 * Здесь мы заполняем данные для коэффициентов для таких типов наград
 * как Денежные призы и баллы лояльности
 */
class CoefficientSeeder extends Seeder
{
    protected array $coefficients = [
        2 => ['id' => 1, 'coefficient' => 0.25]
    ];

    public function run()
    {
        \Illuminate\Support\Facades\DB::beginTransaction();

        foreach ($this->coefficients as $idTypeReward => $coefficients) {
            $typeReward = \App\Models\TypeReward::find($idTypeReward);
            if (!$typeReward)
                throw new \Exception("Такой тип награды не найден");

            try {
                \App\Models\MoneyRewardCofficient::create([
                    'type_reward_from_id' => $idTypeReward,
                    'type_reward_to_id' => $coefficients['id'],
                    'coefficient' => $coefficients['coefficient']
                ]);
            } catch (\Exception $exception) {
                \Illuminate\Support\Facades\DB::rollBack();
                throw new \Exception($exception);
            }

        }
        \Illuminate\Support\Facades\DB::commit();
    }
}
