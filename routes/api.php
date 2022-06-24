<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\NumberController;
use App\Http\Controllers\Api\NumberPreferencesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/customers', class_basename(CustomerController::class));
    Route::resource('/numbers', class_basename(NumberController::class));
    Route::resource('/number-preferences', class_basename(NumberPreferencesController::class));

    Route::get('/number/{number}/preferences', [NumberController::class, 'preferences']);
    Route::get('/dashboard/grouped-by-status', [DashboardController::class, 'getGroupedBy']);
});
