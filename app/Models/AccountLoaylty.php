<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountLoaylty extends Model
{
    protected $fillable = ['user_id', 'points'];
    use SoftDeletes;
}
