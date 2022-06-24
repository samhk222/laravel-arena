<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Domain\Customers\Actions\GetCustomersByStatus;
use Domain\Numbers\Actions\GetNumbersByStatus;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNumbersGroupedByStatus()
    {
        return \response()->json((new GetNumbersByStatus)());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCustomersByStatus()
    {
        return \response()->json((new GetCustomersByStatus)());
    }
}
