<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Addresse;
use App\Models\HomeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Data_umkm;
use App\Models\history;
use Exception;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class CourierController extends Controller
{
    public function index()
    {
        try {
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
                        $item = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders')->getChildKeys();
                        $umkmId[] = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders' . '/' . $item[0] . '/umkm_id')->getValue();
                        $nama_penerima[] = $database->getReference('onProgress/' . $custId . '-' . $courId . '/nama_penerima')->getValue();
                    }
                    $i++;
                }
                if ($umkmId != null) {
                    foreach ($umkmId as $id) {
                        if ($id == 'Jastip') {
                            $no_telp_umkm[] = '-';
                        } else {
                            $no_telp_umkm[] = Data_umkm::find($id)->no_telp_umkm;
                        }
                    }
                    return view('pages/Courier/dashboard', [
                        'Title' => 'Dashboard Courier',
                        // 'nama_umkm' => $nama_umkm,
                        'PengaturanAkun' => HomeModel::pengaturanAkun(),
                        'SeputarDkampus' => HomeModel::seputarDkampus(),
                        'nama_penerima' => $nama_penerima,
                        'no_telp_umkm' => $no_telp_umkm,
                        'orders' => $result,
                        'no_telp_cust' => User::find($custId)->no_telp,
                        'cour_name' => User::find($courId)->nama_user,
                        'custId' => $idCust
                    ]);
                } else {
                    return view('pages/Courier/dashboard', [
                        'Title' => 'Dashboard Courier',
                        // 'nama_umkm' => $nama_umkm,
                        'PengaturanAkun' => HomeModel::pengaturanAkun(),
                        'SeputarDkampus' => HomeModel::seputarDkampus(),
                        // 'nama_penerima' => $nama_penerima,
                        'no_telp_umkm' => null,
                        'orders' => $result,
                        // 'no_telp_cust' => User::find($custId)->no_telp,
                        'cour_name' => User::find($courId)->nama_user,
                    ]);
                }
            } else {
                return view('pages/Courier/dashboard', [
                    'Title' => 'Dashboard Courier',
                    // 'nama_umkm' => $nama_umkm,
                    'SeputarDkampus' => HomeModel::seputarDkampus(),
                    'PengaturanAkun' => HomeModel::pengaturanAkun(),
                    // 'nama_penerima' => $nama_penerima,
                    'no_telp_umkm' => null,
                    'orders' => null,
                    // 'no_telp_cust' => User::find($custId)->no_telp,
                    'cour_name' => User::find($courId)->nama_user,
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function listOrder()
    {
        try {
            return view('pages/Courier/orderspage', [
                'Title' => 'Order',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function takeOrder()
    {
        try {
            $courId = Auth::user()->id;
            $id = request()->input('orderId');
            $database = app('firebase.database');
            // if ($database->getReference('onProgress')->getSnapshot()->exists() && $database->getReference('onProgress')->getSnapshot()->hasChildren()) {
            //     $refId = $database->getReference('onProgress')->getChildKeys();
            //     foreach ($refId as $ids) {
            //         $parts = explode("-", $ids);
            //         $custId = $parts[0];
            //         $refOP = $database->getReference('onProgress/' . $custId . '-' . $courId)->getSnapshot()->exists();
            //         if (!$refOP) {
            //             $data = $database->getReference('needToDeliver/' . $id)->getValue();
            //             $database->getReference('onProgress/' . $id . $courId)->set($data);
            //             $database->getReference('onProgress/' . $id . $courId . '/status')->set('on Delivery');
            //             date_default_timezone_set('Asia/Jakarta');
            //             $timestamp = date('Y-m-d H:i:s');
            //             $custId = explode("-", $id);
            //             $cust_name = User::find($custId[0])->nama_user;
            //             $cour_name = User::find($courId)->nama_user;
            //             $postData = [
            //                 'msgs' => [
            //                     'msg' => "Apakah pesanan sudah sesuai",
            //                     'timestamp' => $timestamp,
            //                     'role' => "driver",
            //                 ],
            //             ];
            //             $database->getReference('chats/' . $id . $courId)->push()->set($postData);
            //             $database->getReference('chats/' . $id . $courId . '/cust_name')->set($cust_name);
            //             $database->getReference('chats/' . $id . $courId . '/cour_name')->set($cour_name);
            //             $database->getReference('chats/' . $id . $courId . '/courNewMssg')->set(1);
            //             $database->getReference('chats/' . $id . $courId . '/custNewMssg')->set(0);
            //             $database->getReference('needToDeliver/' . $id)->remove();
            //             return redirect('courier/dashboard');
            //         } else {
            //             return redirect()->back()->with('error2', 'Anda Masih Memiliki Pesanan Yang Belum Selesai');
            //         }
            //     }
            // } else {
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
            // }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function listChat()
    {
        try {
            $currentUserId = Auth::user()->id;
            return view('pages/Courier/chatpage', [
                'Title' => 'list-chat',
                'courId' => $currentUserId,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function roomChat(Request $request)
    {
        try {
            $courId = Auth::user()->id;
            $custId = $request->input('custId');
            $database = app('firebase.database');
            $cust_name = $database->getReference('chats/' . $custId . '-' . $courId . '/cust_name')->getValue();
            $refKey = $database->getReference('chats/' . $custId . '-' . $courId)->getChildKeys();
            // dd($date);
            foreach ($refKey as $key) {
                $date = $database->getReference('chats/' . $custId . '-' . $courId . '/' . $key . '/msgs/timestamp')->getValue();
                if ($date != null) {
                    break;
                }
            }
            return view('pages/Courier/chatroom', [
                'Title' => 'room-chat',
                'custId' => $custId,
                'courId' => $courId,
                'date' => $date,
                'cust_name' => $cust_name,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function uploadChatImageCour(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/chatsImg');
            $url = Storage::url($path);

            return response()->json(['success' => true, 'imageUrl' => $url]);
        }

        return response()->json(['success' => false, 'error' => 'No image uploaded']);
    }

    public function completeOrder(Request $request)
    {
        try {
            $courId = Auth::user()->id;
            $custId = $request->input('custId');
            $database = app('firebase.database');

            $check = $request->validate([
                'bukti' => 'required|file|mimes:jpeg,jpg,png,heic|max:2048',
            ]);

            if ($check) {
                $file = $request->file('bukti')->store('/public/payment/driver');
                $fileName = basename($file);

                $harga = $database->getReference('onProgress/' . $custId . '-' . $courId . '/total')->getValue();
                $ongkir = $database->getReference('onProgress/' . $custId . '-' . $courId . '/ongkir')->getValue();
                $item = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders')->getValue();
                $orderId = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orderID')->getValue();
                $bukti = $database->getReference('onProgress/' . $custId . '-' . $courId . '/bukti')->getValue();
                $jarak = $database->getReference('onProgress/' . $custId . '-' . $courId . '/jarak')->getValue();
                $kategori = $database->getReference('onProgress/' . $custId . '-' . $courId . '/kategori')->getValue();
                // dd($item);
                $itemNum = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders')->getChildKeys();
                $umkmId = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders' . '/' . $itemNum[0] . '/umkm_id')->getValue();
                $namaJumlahArray = [];
                foreach ($item as $order) {
                    $namaJumlahArray[] = $order['jumlah'] . ' ' . $order['nama'] . ' (' . $order['catatan'] . ')';
                }

                $joinedNamaJumlah = implode(', ', $namaJumlahArray);
                history::create([
                    'user_id' => $custId,
                    'cour_id' => $courId,
                    'umkm_id' => $umkmId,
                    'item' => $joinedNamaJumlah,
                    'harga' => $harga,
                    'ongkir' => $ongkir,
                    'jarak' => $jarak,
                    'status' => 'completed',
                    'bukti' => $bukti,
                    'bukti_akhir' => $fileName,
                    'alasan' => null,
                    'total_driver' => $request->input('total-price'),
                    'kategori' => $kategori,
                    'order_id' => $orderId,
                ]);

                $database->getReference('onProgress/' . $custId . '-' . $courId)->remove();
                return redirect()->back();
            } else {
                return redirect()->back()->with('error2', 'File Bukti Tidak Valid');
            }
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with('error2', 'Gagal Menyelesaikan Order');
        }
    }

    public function cancelOrder(Request $request)
    {
        try {
            $courId = Auth::user()->id;
            $custId = $request->input('custId');
            $database = app('firebase.database');

            $check = $request->validate([
                'bukti_batal' => 'required|file|mimes:jpeg,jpg,png,heic|max:2048',
            ]);

            if ($check) {
                $file = $request->file('bukti_batal')->store('/public/payment/driver');
                $fileName = basename($file);
                $orderId = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orderID')->getValue();
                $harga = $database->getReference('onProgress/' . $custId . '-' . $courId . '/total')->getValue();
                $ongkir = $database->getReference('onProgress/' . $custId . '-' . $courId . '/ongkir')->getValue();
                $jarak = $database->getReference('onProgress/' . $custId . '-' . $courId . '/jarak')->getValue();
                $item = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders')->getValue();
                $bukti = $database->getReference('onProgress/' . $custId . '-' . $courId . '/bukti')->getValue();
                $itemNum = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders')->getChildKeys();
                $kategori = $database->getReference('onProgress/' . $custId . '-' . $courId . '/kategori')->getValue();
                $umkmId = $database->getReference('onProgress/' . $custId . '-' . $courId . '/orders' . '/' . $itemNum[0] . '/umkm_id')->getValue();
                $namaJumlahArray = [];
                foreach ($item as $order) {
                    $namaJumlahArray[] = $order['jumlah'] . ' ' . $order['nama'] . ' (' . $order['catatan'] . ')';
                }

                $joinedNamaJumlah = implode(', ', $namaJumlahArray);
                history::create([
                    'user_id' => $custId,
                    'cour_id' => $courId,
                    'umkm_id' => $umkmId,
                    'item' => $joinedNamaJumlah,
                    'harga' => $harga,
                    'ongkir' => $ongkir,
                    'jarak' => $jarak,
                    'status' => 'canceled',
                    'bukti' => $bukti,
                    'bukti_akhir' => $fileName,
                    'alasan' => $request->input('alasan'),
                    'total_driver' => $request->input('total-price-cancel'),
                    'kategori' => $kategori,
                    'order_id' => $orderId,
                ]);
                $database->getReference('onProgress/' . $custId . '-' . $courId)->remove();
                return redirect()->back()->with('success', 'Berhasil Membatalkan Orderan');
            }
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with('error2', 'gagal menghapus data');
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
                $namaUmkm[] = $history->umkm_id == 0 ? 'Jastip' : Data_umkm::find($history->umkm_id)->nama_umkm;
            }
            return view('pages/Courier/riwayat', [
                'Title' => 'History',
                'data' => $data,
                'nama_umkm' => $namaUmkm,
            ]);
        } catch (Exception $e) {
            return view('pages/Courier/riwayat', [
                'Title' => 'History',
                'data' => null,
            ]);
        }
    }

    public function detailHistory()
    {
        try {
            $custId = request()->custId;
            $id = request()->id;
            $cust_name = User::find($custId)->nama_user;
            $courId = Auth::user()->id;
            $data = User::find($courId)->courHistory;
            foreach ($data as $history) {
                if ($history->cour_id == $courId && $history->user_id == $custId && $history->id == $id) {
                    $nama_umkm = $history->umkm_id == 0 ? 'Jastip' : Data_umkm::find($history->umkm_id)->nama_umkm;
                    return view('pages/Courier/riwayatdetail', [
                        'Title' => 'Detail history' . ' | #TRX' . strtoupper(substr($history->order_id, 0, 10)),
                        'cust_name' => $cust_name,
                        'status' => $history->status,
                        'custId' => $custId,
                        'umkm' => $nama_umkm,
                        'id' => $history->order_id,
                        'total' => $history->harga,
                        'ongkir' => $history->ongkir,
                    ]);
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }
}
