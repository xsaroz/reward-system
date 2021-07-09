<?php

namespace Kunyo\RewardSystem\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Kunyo\RewardSystem\Models\CreateOrderProductRequestFilter;
use Kunyo\RewardSystem\Models\CreateOrderRequestFilter;
use Kunyo\RewardSystem\Repositories\OrderProductInterface;
use Kunyo\RewardSystem\Repositories\OrderInterface;
use Kunyo\RewardSystem\Repositories\RewardInterface;

/**
 * OrderController
 */
class OrderController extends Controller
{
    protected $order, $orderProduct, $reward;

    /**
     * constructore
     *
     * @param OrderInterface $order
     * @param OrderProductInterface $orderProduct
     * @param RewardInterface $reward
     */
    public function __construct(OrderInterface $order, OrderProductInterface $orderProduct, RewardInterface $reward)
    {
        $this->order = $order;
        $this->orderProduct = $orderProduct;
        $this->reward = $reward;
    }

    /**
     * store
     *
     * @param Request $request
     * @return [array]
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        // Begin database transactions
        DB::beginTransaction();

        try {
            foreach ($requestData as $orderData) {
                // CreateOrderRequestFilter filters arrays for entries to orders table
                $createOrderRequestFilter = new CreateOrderRequestFilter($orderData);
                // Get total sum of the products of that particular order
                $createOrderRequestFilter['order_total'] = array_sum(array_column($orderData['products'], $orderData['sales_type'] == "Normal" ? "normal_price" : "promotion_price"));

                $order = $this->order->createOrder($createOrderRequestFilter->toArray());

                // Save products
                foreach ($orderData['products'] as $product) {
                    // CreateOrderProductRequestFilter filters products data
                    $createOrderProductRequestFilter = new CreateOrderProductRequestFilter($product);

                    $this->orderProduct->createOrderProducts($order->order_id, $createOrderProductRequestFilter->toArray());
                }
            }
            // For successful entries commit to database
            DB::commit();
        } catch (\Throwable $th) {
            // For errors rollback entries
            DB::rollBack();
            // Return error message/response
            return response()->json([
                "code" => "error",
                "message" => $th->getMessage()
            ]);
        }

        // Return success message
        return response()->json([
            "code" => "success",
            "message" => "Order Created Successfully"
        ]);
    }

    /**
     * list
     *
     * @return [array]
     */
    public function list()
    {
        // List orders
        $orderDetails = $this->order->listOrders();

        return response()->json($orderDetails, 200);
    }

    /**
     * update_status
     *
     * @param Request $request
     * @return [array]
     */
    public function update_status(Request $request)
    {
        $orderData = $request->all();
        // Begin transaction for updating order
        DB::beginTransaction();
        foreach ($orderData as $key => $order) {
            $orderResponse = $this->order->updateOrderStatus($order['order_id'], $order['status']);
            // If there is success response on updating and has complete status -> there will be reward
            if ($orderResponse['code'] == "success" && $order['status'] == "complete") {
                $updatedOrder = $orderResponse['order'];
                $this->reward->createCustomerReward($updatedOrder->fk_customer_id, $updatedOrder->order_id, $updatedOrder->order_total);
            } else {
                DB::rollBack();
                return response()->json([
                    "code" => "error",
                    "message" => $orderResponse["message"]
                ]);
            }
        }
        DB::commit();

        // return success response
        return response()->json([
            "code" => "success",
            "message" => "Orders status updated successfully"
        ], 200);
    }
}
