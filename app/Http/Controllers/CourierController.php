<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Data_umkm;
use App\Models\history;
use Exception;
use PhpParser\Node\Expr\FuncCall;

class CourierController extends Controller
{
    public function index()
    {
        $courId = Auth::user()->id;
        $database = app('firebase.database');
        $reference = $database->getReference('onProgress/');
        $snapshot = $reference->getSnapshot();
        if ($snapshot->exists()) {
            $uid_user = $database->getReference('onProgress/')->getChildKeys();
            $itemCount = $database->getReference('onProgress/')->getSnapshot()->numChildren();
            $umkmId = [];
            $result = [];
            $custId = [];
            $idCust = [];
            $i = 0;
            while ($i < $itemCount) {
                $getUid = explode("-", $uid_user[$i]);
                if ($getUid[1] == $courId) {
                    $custId = $getUid[0];
                    $idCust[] = $getUid[0];
                    $result[] = $database->getReference('onProgress/' . $custId . '-' . $courId)->getValue();
                    $umkmId[] = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders/item1/umkm_id')->getValue();
                    $nama_penerima[] = $database->getReference('onProgress/' . $custId . '-' . $courId . '/nama_penerima')->getValue();
                }
                $i++;
            }
            // dd($idCust);
            if ($umkmId != null) {
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
                    'custId' => $idCust
                ]);
            } else {
                return view('pages/Courier/dashboard', [
                    'Title' => 'Dashboard',
                    // 'nama_umkm' => $nama_umkm,
                    // 'nama_penerima' => $nama_penerima,
                    'no_telp_umkm' => null,
                    'orders' => $result,
                    // 'no_telp_cust' => User::find($custId)->no_telp,
                    'cour_name' => User::find($courId)->nama_user,
                ]);
            }
        } else {
            return view('pages/Courier/dashboard', [
                'Title' => 'Dashboard',
                // 'nama_umkm' => $nama_umkm,
                // 'nama_penerima' => $nama_penerima,
                'no_telp_umkm' => null,
                'orders' => null,
                // 'no_telp_cust' => User::find($custId)->no_telp,
                'cour_name' => User::find($courId)->nama_user,
            ]);
        }
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
        $database->getReference('onProgress/' . $id . $courId . '/status')->set('on Delivery');
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
        $database->getReference('chats/' . $id . $courId . '/courNewMssg')->set(1);
        $database->getReference('chats/' . $id . $courId . '/custNewMssg')->set(0);
        $database->getReference('needToDeliver/' . $id)->remove();
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

    public function completeOrder(Request $request)
    {
        try {
            $courId = Auth::user()->id;
            $custId = $request->input('custId');
            $database = app('firebase.database');

            $harga = $database->getReference('onProgress/' . $custId . '-' . $courId . '/total')->getValue();
            $ongkir = $database->getReference('onProgress/' . $custId . '-' . $courId . '/ongkir')->getValue();
            $item = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders')->getValue();
            $orderId = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orderID')->getValue();
            // dd($item);
            $umkmId = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders/item1/umkm_id')->getValue();
            $namaJumlahArray = [];
            foreach ($item as $order) {
                $namaJumlahArray[] = $order['jumlah'] . ' ' . $order['nama'];
            }

            $joinedNamaJumlah = implode(', ', $namaJumlahArray);
            history::create([
                'user_id' => $custId,
                'cour_id' => $courId,
                'umkm_id' => $umkmId,
                'item' => $joinedNamaJumlah,
                'harga' => $harga,
                'ongkir' => $ongkir,
                'status' => 'completed',
                'order_id' => $orderId,
            ]);

            $database->getReference('onProgress/' . $custId . '-' . $courId)->remove();
            return redirect()->back();
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'gagal menghapus data');
        }
    }

    public function cancelOrder(Request $request)
    {
        try {
            $courId = Auth::user()->id;
            $custId = $request->input('custId');
            $database = app('firebase.database');
            $orderId = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orderID')->getValue();
            $harga = $database->getReference('onProgress/' . $custId . '-' . $courId . '/total')->getValue();
            $ongkir = $database->getReference('onProgress/' . $custId . '-' . $courId . '/ongkir')->getValue();
            $item = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders')->getValue();
            $umkmId = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders/item1/umkm_id')->getValue();
            $namaJumlahArray = [];
            foreach ($item as $order) {
                $namaJumlahArray[] = $order['jumlah'] . ' ' . $order['nama'];
            }

            $joinedNamaJumlah = implode(', ', $namaJumlahArray);
            history::create([
                'user_id' => $custId,
                'cour_id' => $courId,
                'umkm_id' => $umkmId,
                'item' => $joinedNamaJumlah,
                'harga' => $harga,
                'ongkir' => $ongkir,
                'status' => 'canceled',
                'order_id' => $orderId,
            ]);
            $database->getReference('onProgress/' . $custId . '-' . $courId)->remove();
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'gagal menghapus data');
        }
    }

    public function history()
    {
        try {
            $courId = Auth::user()->id;
            $data = User::find($courId)->courHistory;
            foreach ($data as $history) {
                $dataCustId[] = $history->user_id;
                $dataCourId[] = $history->cour_id;
                $namaUmkm[] = Data_umkm::find($history->umkm_id)->nama_umkm;
            }
            return view('pages/Courier/riwayat', [
                'Title' => 'history',
                'data' => $data,
                'nama_umkm' => $namaUmkm,
            ]);
        } catch (Exception $e) {
            return view('pages/Courier/riwayat', [
                'Title' => 'history',
                'data' => null,
            ]);
        }
    }

    public function detailHistory()
    {
        $custId = request()->custId;
        $cust_name = User::find($custId)->nama_user;
        $courId = Auth::user()->id;
        $data = User::find($courId)->courHistory;
        foreach ($data as $history) {
            if ($history->user_id == $custId) {
                return view('pages/Courier/riwayatdetail', [
                    'Title' => 'detail history',
                    'cust_name' => $cust_name,
                    'status' => $history->status,
                    'custId' => $custId,
                    'umkm' => Data_umkm::find($history->umkm_id)->nama_umkm,
                    'id' => $history->order_id,
                    'total' => $history->harga,
                    'ongkir' => $history->ongkir,
                ]);
            }
        }
    }
}
