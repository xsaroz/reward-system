<?php

namespace Kunyo\RewardSystem\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_product_id';

    /**
     * The fillable values for the table
     *
     * @var array
     */
    protected $fillable = ['fk_order_id', 'item_name', 'normal_price', 'promotion_price'];
}

