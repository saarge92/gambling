<?php


namespace App\Repositories;


use App\Interfaces\Repositories\ITypeRewardRepository;
use App\Models\TypeReward;

/**
 * Репозиторий по работе с типами наград
 * @package App\Repositories
 * @author Serdar Durdyev
 */
class TypeRewardRepository implements ITypeRewardRepository
{
    /**
     * Создание типа наград в системе
     * @param array $data Данные для создания записи
     * @return TypeReward Возвращаем созданную записи с типом вознаграждения
     */
    public function create(array $data): TypeReward
    {
        return TypeReward::create([
            'name' => $data['name']
        ]);
    }

    /**
     * Случайным образом получаем тип вознаграждения из таблицы
     * @return TypeReward|null Найденная или пустая запись из таблицы type_rewards
     */
    public function generateRandom(): ?TypeReward
    {
        return TypeReward::orderByRaw("RAND()")->first();
    }
}
