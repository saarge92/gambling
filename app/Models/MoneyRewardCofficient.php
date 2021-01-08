<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoneyRewardCofficient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type_reward_from_id', 'type_reward_to_id', 'coefficient'
    ];
}
