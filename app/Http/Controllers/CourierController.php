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
        return view('pages/Courier/dashboard', [
            'Title' => 'Dashboard',
        ]);
    }

    public function listOrder()
    {
        return view('pages/Courier/orderspage', [
            'Title' => 'Order',
        ]);
    }

    public function takeOrder(Request $request)
    {
        $id = request()->input('orderId');
        $database = app('firebase.database');
        $data = $database->getReference('needToDeliver/' . $id)->getValue();
        dd($data);
        return view('pages/Courier/dashboard', [
            'Title' => 'Dashboard',
        ]);
    }
}
