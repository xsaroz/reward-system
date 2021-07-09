<?php

namespace Kunyo\RewardSystem\Repositories;

use Carbon\Carbon;
use Kunyo\RewardSystem\Models\CustomerOrderReward;

/**
 * RewardRepository
 */
class RewardRepository implements RewardInterface
{
    /**
     * createCustomerReward
     *
     * @param [int] $customerId
     * @param [int] $orderId
     * @param [decimal] $orderTotal
     * @return void
     */
    public function createCustomerReward($customerId, $orderId, $orderTotal)
    {
        // save reward of customer values
        return CustomerOrderReward::create([
            'fk_customer_id' => $customerId,
            'fk_order_id' => $orderId, 
            'reward_amount' => floatval($orderTotal) / 100,
            'reward_point' => $orderTotal,
            'expiry_date' => Carbon::now()->addYear()
        ]);

    }
}
