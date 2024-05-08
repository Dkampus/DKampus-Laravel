<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Data_umkm;

class CourierController extends Controller
{
    public function index()
    {
        return view('pages/Courier/orderspage', [
            'Title' => 'Order',
        ]);
    }
}
