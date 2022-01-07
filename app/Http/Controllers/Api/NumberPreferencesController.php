<?php


namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\V1\NumberPreferences\DeleteRequest;
use App\Http\Requests\Api\V1\NumberPreferences\StoreRequest;
use App\Http\Requests\Api\V1\NumberPreferences\UpdateRequest;
use App\Http\Resources\NumberPreferencesResource;
use App\Http\Resources\NumberResource;
use App\Jobs\NumberPreferences\Store;
use App\Models\Number;
use App\Models\NumberPreference;

class NumberPreferencesController
{
    /**
     * Show the application dashboard.
     *
     * @param StoreRequest $request
     * @return NumberPreferencesResource
     */
    public function store(StoreRequest $request)
    {
        $number_preference = Store::dispatchNow($request->get('number_id'), $request->validated());

        return new NumberPreferencesResource($number_preference);
    }

    /**
     * @param Number $number
     * @param UpdateRequest $request
     * @return NumberPreferencesResource
     */
    public function update(NumberPreference $number_preference, UpdateRequest $request)
    {
        $number_preference->update($request->validated());

        return new NumberPreferencesResource($number_preference->refresh());
    }

    public function destroy(NumberPreference $number_preference, DeleteRequest $request)
    {
        $number_preference->delete();

        return response()->json("Preference deleted");
    }
}
