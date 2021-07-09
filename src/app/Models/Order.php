<?php

namespace Kunyo\RewardSystem\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_id';

    /**
     * The fillable values of table.
     *
     * @var array
     */
    protected $fillable = ['sales_type', 'order_date', 'fk_customer_id', 'order_total', 'status'];
}
