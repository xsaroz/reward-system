<?php
namespace Kunyo\RewardSystem\Repositories;

interface RewardInterface {
    public function createCustomerReward($customerId, $orderId, $orderTotal);
}
