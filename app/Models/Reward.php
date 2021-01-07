<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    use SoftDeletes;

    protected $table = 'rewards';

    protected $fillable = ['name', 'count', 'id_type_reward'];
}
