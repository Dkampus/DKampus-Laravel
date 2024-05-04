<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index()
    {
        return view('pages/Courier/orderspage', [
            'Title' => 'Order',
        ]);
    }
}
