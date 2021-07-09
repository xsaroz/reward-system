<?php

namespace Kunyo\RewardSystem\Repositories;

use Kunyo\RewardSystem\Models\Order;

/**
 * OrderRepository
 */
class OrderRepository implements OrderInterface
{
    /**
     * createOrders
     *
     * @param [array] $orders
     * @return [array]
     */
    public function createOrder($orders)
    {
        // save orders values
        return Order::create($orders);

    }

    public function listOrders()
    {
        $orders = Order::all();
        
        return [
            "number_of_order" => $orders->count(),
            "total_sales_amount" => "$" . number_format(floatval($orders->sum('order_total')), 2),
            "orders" => $orders
        ];
    }

    public function updateOrderStatus($orderId, $status)
    {
        try {
            Order::find($orderId)->update(['status' => strtolower($status)]);
            return [
                "code" => "success",
                "message" => "Order Status Updated Successfully",
                "order" => Order::find($orderId)
            ];
        } catch (\Throwable $th) {
            return [
                "code" => "error",
                "message" => $th->getMessage()
            ];
        }
    }

}
