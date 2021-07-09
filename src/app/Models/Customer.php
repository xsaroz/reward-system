<?php

namespace Kunyo\RewardSystem\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'address'];
}
