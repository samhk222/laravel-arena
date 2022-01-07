<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;

class CustomerNumberController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Customer $customer)
    {
        $statuses    = (new StatusRepository())->filter('allow_numbers');
        $number_mask = \config('custom.mask');

        return \view('numbers.index', \compact('customer', 'statuses', 'number_mask'));
    }
}
