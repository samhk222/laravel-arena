<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $statuses = (new StatusRepository())->filter('allow_customers');

        return view('customers.index', compact('statuses'));
    }
}
