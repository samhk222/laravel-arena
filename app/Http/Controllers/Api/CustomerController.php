<?php


namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\V1\Customers\IndexRequest;
use App\Http\Requests\Api\V1\Customers\StoreRequest;
use App\Http\Requests\Api\V1\Customers\UpdateRequest;
use App\Http\Resources\CustomerResource;
use App\Jobs\Customers\Store;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $customers = (new CustomerRepository())->filter($request->validated());

        return CustomerResource::collection($customers);
    }

    /**
     * Show the application dashboard.
     *
     * @return CustomerResource
     */
    public function store(StoreRequest $request)
    {
        $customer = Store::dispatchNow($request->validated());

        return new CustomerResource($customer);
    }

    /**
     * @param Customer $customer
     * @return CustomerResource
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * @param Customer $customer
     * @return CustomerResource
     */
    public function update(Customer $customer, UpdateRequest $request)
    {
        $customer->update($request->validated());

        return new CustomerResource($customer->refresh());
    }
}
