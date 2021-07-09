<?php

namespace Kunyo\RewardSystem\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Kunyo\RewardSystem\Repositories\CustomerInterface;

/**
 * CustomerController
 */
class CustomerController extends Controller
{
    protected $customer;

    /**
     * constructor
     *
     * @param CustomerInterface $Customer
     */
    public function __construct(CustomerInterface $Customer)
    {
        $this->Customer = $Customer;
    }

    public function store(Request $request)
    {
        return $this->Customer->createCustomers($request->all());
    }
}
