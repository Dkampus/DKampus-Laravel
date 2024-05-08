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
        $courId = Auth::user()->id;
        $database = app('firebase.database');
        $uid_user = $database->getReference('onProgress/')->getChildKeys();
        $itemCount = $database->getReference('onProgress/')->getSnapshot()->numChildren();
        $custId = "";
        $i = 0;
        while ($i < $itemCount) {
            $getUid = explode("-", $uid_user[$i]);
            if ($getUid[1] == $courId) {
                $custId = $getUid[0];
                $courId = $getUid[1];
            }
            $i++;
        }
        $nama_umkm = $database->getReference('onProgress/' . $custId . '-' . $courId . '/nama_umkm')->getValue();
        $nama_penerima = $database->getReference('onProgress/' . $custId . '-' . $courId . '/nama_penerima')->getValue();
        $no_telp_umkm = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders/item1/id')->getValue();

        return view('pages/Courier/dashboard', [
            'Title' => 'Dashboard',
            'nama_umkm' => $nama_umkm,
            'nama_penerima' => $nama_penerima,
            'no_telp_umkm' => Data_umkm::find($no_telp_umkm)->no_telp_umkm,
            'no_telp_cust' => User::find($custId)->no_telp,
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
        $courId = Auth::user()->id;
        $id = request()->input('orderId');
        $database = app('firebase.database');
        $data = $database->getReference('needToDeliver/' . $id)->getValue();
        $database->getReference('onProgress/' . $id . $courId)->set($data);
        $nama_umkm = $database->getReference('onProgress/' . $id . $courId . '/nama_umkm')->getValue();
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        $postData = [
            'msgs' => [
                'msg' => "Apakah pesanan sudah sesuai",
                'timestamp' => $timestamp,
                'role' => "driver",
            ],
        ];
        $database->getReference('chats/' . $id . $courId)->push()->set($postData);
        return redirect('courier/dashboard');
    }
}
