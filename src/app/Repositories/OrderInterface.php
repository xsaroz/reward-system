<?php
namespace Kunyo\RewardSystem\Repositories;

interface OrderInterface {
    public function createOrder($orders);
    public function listOrders();
    public function updateOrderStatus($orderId, $status);
}
