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
                $result[] = $database->getReference('onProgress/' . $custId . '-' . $courId)->getValue();
                $umkmId[] = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders/item1/umkm_id')->getValue();
                $nama_penerima[] = $database->getReference('onProgress/' . $custId . '-' . $courId . '/nama_penerima')->getValue();
            }
            $i++;
        }
        foreach ($umkmId as $id) {
            $no_telp_umkm[] = Data_umkm::find($id)->no_telp_umkm;
        }

        return view('pages/Courier/dashboard', [
            'Title' => 'Dashboard',
            // 'nama_umkm' => $nama_umkm,
            'nama_penerima' => $nama_penerima,
            'no_telp_umkm' => $no_telp_umkm,
            'orders' => $result,
            'no_telp_cust' => User::find($custId)->no_telp,
            'cour_name' => User::find($courId)->nama_user,
        ]);
    }

    public function listOrder()
    {
        return view('pages/Courier/orderspage', [
            'Title' => 'Order',
        ]);
    }

    public function takeOrder()
    {
        $courId = Auth::user()->id;
        $id = request()->input('orderId');
        $database = app('firebase.database');
        $data = $database->getReference('needToDeliver/' . $id)->getValue();
        $database->getReference('onProgress/' . $id . $courId)->set($data);
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        $custId = explode("-", $id);
        $cust_name = User::find($custId[0])->nama_user;
        $cour_name = User::find($courId)->nama_user;
        $postData = [
            'msgs' => [
                'msg' => "Apakah pesanan sudah sesuai",
                'timestamp' => $timestamp,
                'role' => "driver",
            ],
        ];
        $database->getReference('chats/' . $id . $courId)->push()->set($postData);
        $database->getReference('chats/' . $id . $courId . '/cust_name')->set($cust_name);
        $database->getReference('chats/' . $id . $courId . '/cour_name')->set($cour_name);
        return redirect('courier/dashboard');
    }

    public function listChat()
    {
        $currentUserId = Auth::user()->id;
        return view('pages/Courier/chatpage', [
            'Title' => 'list-chat',
            'courId' => $currentUserId,
        ]);
    }

    public function roomChat(Request $request)
    {
        $courId = Auth::user()->id;
        $custId = $request->input('custId');
        $database = app('firebase.database');
        $cust_name = $database->getReference('chats/' . $custId . '-' . $courId . '/cust_name')->getValue();
        $refKey = $database->getReference('chats/' . $custId . '-' . $courId)->getChildKeys();
        $date = $database->getReference('chats/' . $custId . '-' . $courId . '/' . $refKey[0] . '/msgs/timestamp')->getValue();
        // dd($date);
        return view('pages/Courier/chatroom', [
            'Title' => 'room-chat',
            'custId' => $custId,
            'courId' => $courId,
            'date' => $date,
            'cust_name' => $cust_name,
        ]);
    }
}
