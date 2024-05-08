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
        $userID = Auth::user()->id;
        $database = app('firebase.database');
        $refId = $database->getReference('needToDeliver/')->getChildKeys();

        $refOrder = $database->getReference('needToDeliver/')->getValue();
        $itemCount = $database->getReference('needToDeliver/')->getSnapshot()->numChildren();
        $i = 0;
        while ($i < $itemCount) {
            $getUid = explode("-", $refId[$i]);
            $names[] = User::find($getUid[0])->nama_user;
            $refIdUmkm = $database->getReference('needToDeliver/' . $refId[$i] . '/orders/item1/umkm_id')->getValue();
            $umkmNames[] = Data_umkm::find($refIdUmkm)->nama_umkm;

            $i++;
        }

        return view('pages/Courier/orderspage', [
            'Title' => 'Order',
            'nama_penerima' => $names,
            'dataOrder' => $refOrder,
            'nama_umkm' => $umkmNames,
        ]);
    }
}
