<?php

namespace Kunyo\RewardSystem\Models;

use Illuminate\Database\Eloquent\Model;

class CreateOrderRequestFilter extends Model
{
    protected $fillable = ['sales_type', 'order_date', 'fk_customer_id', 'order_total'];
}
