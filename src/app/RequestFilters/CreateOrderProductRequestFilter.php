<?php

namespace Kunyo\RewardSystem\Models;

use Illuminate\Database\Eloquent\Model;

class CreateOrderProductRequestFilter extends Model
{
    protected $fillable = ['item_name', 'normal_price', 'promotion_price'];
}
