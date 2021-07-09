<?php
namespace Kunyo\RewardSystem\Repositories;

use Kunyo\RewardSystem\Models\Customer;

class CustomerRepository implements CustomerInterface
{
    /**
     * createCustomers
     *
     * @param [array] $customers
     * @return [array]
     */
    public function createCustomers($customers)
    {
        try {
            // save orders values
            Customer::insert($customers);

            // return success message with success value and message
            return [
                "success" => "true",
                "message" => "Customers Created Successfully"
            ];
        } catch (\Throwable $th) {
            // send success false with message
            return [
                "success" => "false",
                "message" => $th->getMessage()
            ];
        }
    }

}
