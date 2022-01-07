<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;
use App\Repositories\NumberRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_numbers   = (new NumberRepository())->count();
        $total_customers = (new CustomerRepository())->count();

        return view('dashboard', \compact('total_numbers', 'total_customers'));
    }
}
