<?php

namespace Kunyo\RewardSystem\Repositories;

use Kunyo\RewardSystem\Models\OrderProduct;

class OrderProductRepository implements OrderProductInterface
{
    public function createOrderProducts($order_id, $orderProducts)
    {
        // save orders values
        $productData = array_merge(['fk_order_id' => $order_id], $orderProducts);
        OrderProduct::insert($productData);

        return [
            "success" => "true",
            "message" => "Order Products Created Successfully"
        ];
    }
}
