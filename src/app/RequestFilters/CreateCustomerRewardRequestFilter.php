<?php

namespace Kunyo\RewardSystem\Models;

use Illuminate\Database\Eloquent\Model;

class CreateCustomerRewardRequestFilter extends Model
{
    protected $fillable = ['fk_customer_id', 'fk_order_id', 'total_amount', 'reward_point'];
}
