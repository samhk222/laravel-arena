<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerNumberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NumberController;
use App\Repositories\NumberRepository;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/dashboard');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/numbers', [NumberController::class, 'index'])->name('numbers');

    Route::get('/customers/{customer}/numbers', [CustomerNumberController::class, 'index'])->name('customers-phone');
});

Auth::routes();
