<?php


namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\V1\Numbers\IndexRequest;
use App\Http\Requests\Api\V1\Numbers\StoreRequest;
use App\Http\Requests\Api\V1\Numbers\UpdateRequest;
use App\Http\Resources\NumberPreferencesResource;
use App\Http\Resources\NumberResource;
use App\Jobs\Numbers\Store;
use App\Models\Number;
use App\Repositories\NumberRepository;

class NumberController
{

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $numbers = (new NumberRepository())->filter($request->validated());

        return NumberResource::collection($numbers);
    }

    /**
     * Show the application dashboard.
     *
     * @param StoreRequest $request
     * @return NumberResource
     */
    public function store(StoreRequest $request)
    {
        $number = Store::dispatchNow($request->validated());

        return new NumberResource($number);
    }

    /**
     * @param Number $number
     * @return NumberResource
     */
    public function show(Number $number)
    {
        return new NumberResource($number);
    }

    /**
     * @param Number $number
     * @param UpdateRequest $request
     * @return NumberResource
     */
    public function update(Number $number, UpdateRequest $request)
    {
        $number->update($request->validated());

        return new NumberResource($number->refresh());
    }

    /**
     * @param Number $number
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function preferences(Number $number)
    {
        return NumberPreferencesResource::collection($number->number_preferences);
    }
}
