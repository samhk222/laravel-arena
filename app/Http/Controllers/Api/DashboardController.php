<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Domain\Numbers\Actions\GetNumbersByStatus;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGroupedBy()
    {
        return \response()->json((new GetNumbersByStatus)());
    }
}
