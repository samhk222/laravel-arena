<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $statuses    = (new StatusRepository())->filter('allow_numbers');
        $number_mask = \config('custom.mask');

        return view('numbers.index', \compact('statuses', 'number_mask'));
    }
}
