<?php
namespace Kunyo\RewardSystem\Repositories;

interface OrderProductInterface {
    public function createOrderProducts($order_id, $orderProducts);
}
