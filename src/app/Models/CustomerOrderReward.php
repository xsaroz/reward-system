<?php

namespace Kunyo\RewardSystem\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * CustomerOrderReward
 */
class CustomerOrderReward extends Model
{
    protected $fillable = ['fk_customer_id', 'fk_order_id', 'reward_amount', 'reward_point', 'expiry_date'];
}
