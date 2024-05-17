<?php

namespace App\Http\Controllers;

use App\Models\HomeModel;
use App\Models\Cart;
use App\Models\User;
use App\Models\Addresse;
use App\Models\Favorit;
use App\Models\Menu;
use App\Models\PesananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Data_umkm;
use App\Models\history;
use Exception;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

use function PHPSTORM_META\type;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $userID = Auth::user()->id;
            $alamat = User::find($userID);
            $database = app('firebase.database');
            $test = $database->getReference('cart/' . $userID . '/orders')->getValue();
            $listAlamat = $alamat->addresses()->where('user_id', $userID)->get();
            $alamatUtama = $alamat->addresses()->where('user_id', $userID)->where('utama', 1)->first();
            if ($test  !== null && $alamat !== null) {
                $idumkm = $database->getReference('cart/' . $userID . '/orders/item1/umkm_id')->getValue();
                $namaUMKM = Data_umkm::find($idumkm);
                return view('pages.Users.Pesanan', [
                    'Title' => 'Pesanan',
                    'NavPesanan' => 'Pesanan',
                    //"favorites" => Favorit::where('user_id', auth()->user()->id)->get(),
                    'data' => $test,
                    'namaUMKM' => $namaUMKM->nama_umkm,
                    'AddressList' => $listAlamat,
                    'alamatUtama' => $alamatUtama,
                    'PengaturanAkun' => HomeModel::pengaturanAkun(),
                    'SeputarDkampus' => HomeModel::seputarDkampus(),
                ]);
            } else if ($alamat !== null && $alamatUtama !== null) {
                return view('pages.Users.Pesanan', [
                    'Title' => 'Pesanan',
                    'NavPesanan' => 'Pesanan',
                    //"favorites" => Favorit::where('user_id', auth()->user()->id)->get(),
                    'data' => null,
                    'namaUMKM' => null,
                    'AddressList' => $listAlamat,
                    'alamatUtama' => $alamatUtama,
                    'PengaturanAkun' => HomeModel::pengaturanAkun(),
                    'SeputarDkampus' => HomeModel::seputarDkampus(),
                ]);
            } else if ($alamat !== null) {
                return view('pages.Users.Pesanan', [
                    'Title' => 'Pesanan',
                    'NavPesanan' => 'Pesanan',
                    //"favorites" => Favorit::where('user_id', auth()->user()->id)->get(),
                    'data' => null,
                    'namaUMKM' => null,
                    'AddressList' => $listAlamat,
                    'alamatUtama' => null,
                    'PengaturanAkun' => HomeModel::pengaturanAkun(),
                    'SeputarDkampus' => HomeModel::seputarDkampus(),
                ]);
            };
        } catch (\Exception $e) {
            return view('pages.Users.Pesanan', [
                'Title' => 'Pesanan',
                'NavPesanan' => 'Pesanan',
                'carts' => "",
                'test' => "",
                'data' => null,
                'namaUMKM' => null,
                'AddressList' => null,
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
                'SeputarDkampus' => HomeModel::seputarDkampus(),
            ]);
        }
    }

    public function status()
    {
        $userID = Auth::user()->id;
        try {
            $data = User::find($userID)->custHistory;
            foreach ($data as $history) {
                $dataCustId[] = $history->user_id;
                $dataCourId[] = $history->cour_id;
                $namaUmkm[] = Data_umkm::find($history->umkm_id)->nama_umkm;
            }
            return view('pages.Users.Status', [
                'Title' => 'Status',
                'NavPesanan' => 'Status',
                'custId' => $userID,
                'data' => $data,
                'nama_umkm' => $namaUmkm,
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
                'SeputarDkampus' => HomeModel::seputarDkampus(),
            ]);
        } catch (Exception $e) {
            return view('pages.Users.Status', [
                'Title' => 'Status',
                'NavPesanan' => 'Status',
                'custId' => $userID,
                'data' => null,
                'nama_umkm' => null,
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
                'SeputarDkampus' => HomeModel::seputarDkampus(),
            ]);
        }
    }

    public function StatusOrder(Request $request)
    {
        try {
            $database = app('firebase.database');
            $id = Auth::user()->id;
            $courId = $request->courId;
            if ($courId !== null) {
                $orderId = substr($database->getReference('onProgress/' . $id . '-' . $courId . '/orderID')->getValue(), 0, 10);
                $status = $database->getReference('onProgress/' . $id . '-' . $courId . '/status')->getValue();
                $subTotal = $database->getReference('onProgress/' . $id . '-' . $courId . '/total')->getValue();
                $ongkir = $database->getReference('onProgress/' . $id . '-' . $courId . '/ongkir')->getValue();
                $nama_umkm = $database->getReference('onProgress/' . $id . '-' . $courId . '/nama_umkm')->getValue();
                $orders = $database->getReference('onProgress/' . $id . '-' . $courId . '/orders')->getValue();
                // dd($status);
                $nama_driver = User::find($courId)->nama_user;
                return view('pages.Users.StatusOrder', [
                    'Title' => 'Status Order',
                    'NavPesanan' => 'Status Order',
                    'id' => $id,
                    'orderId' => $orderId,
                    'status' => $status,
                    'subTotal' => $subTotal,
                    'ongkir' => $ongkir,
                    'total' => $ongkir + $subTotal,
                    'nama_umkm' => $nama_umkm,
                    'nama_driver' => $nama_driver,
                    'orders' => $orders,
                    'items' => null,
                ]);
            } else {
                $stringOrder = $database->getReference('needToDeliver/' . $id . '-/orderID')->getValue();
                $orderId = substr($stringOrder, 0, 10);
                $status = $database->getReference('needToDeliver/' . $id . '-/status')->getValue();
                $subTotal = $database->getReference('needToDeliver/' . $id . '-/total')->getValue();
                $ongkir = $database->getReference('needToDeliver/' . $id . '-/ongkir')->getValue();
                $orders = $database->getReference('needToDeliver/' . $id . '-/orders')->getValue();
                // dd($orders);
                $nama_umkm = $database->getReference('needToDeliver/' . $id . '-/nama_umkm')->getValue();
                return view('pages.Users.StatusOrder', [
                    'Title' => 'Status Order',
                    'NavPesanan' => 'Status Order',
                    'id' => $id,
                    'orderId' => $orderId,
                    'status' => $status,
                    'subTotal' => $subTotal,
                    'ongkir' => $ongkir,
                    'total' => $ongkir + $subTotal,
                    'nama_umkm' => $nama_umkm,
                    'nama_driver' => null,
                    'orders' => $orders,
                    'items' => null,
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function detailHistory()
    {
        try {
            $courId = request()->courId;
            $id = request()->id;
            $custId = Auth::user()->id;
            $data = User::find($custId)->custHistory;
            foreach ($data as $history) {
                if ($history->user_id == $custId && $id == $history->id) {
                    return view('pages.Users.StatusOrder', [
                        'Title' => 'Detail Order',
                        'NavPesanan' => 'Detail Order',
                        'id' => $custId,
                        'orderId' => $history->order_id,
                        'status' => $history->status,
                        'subTotal' => $history->harga,
                        'ongkir' => $history->ongkir,
                        'total' => $history->ongkir + $history->harga,
                        'nama_umkm' => Data_umkm::find($history->umkm_id)->nama_umkm,
                        'nama_driver' => User::find($courId)->nama_user,
                        'orders' => null,
                        'items' => $history->item,
                    ]);
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function updateQuantity(Request $request)
    {
        try {

            $userID = Auth::user()->id;
            $idBarang = $request->id;
            $database = app('firebase.database');

            $kuantitas = $request->quantity;

            $itemCount = $database->getReference('cart/' . $userID . '/orders')->getSnapshot()->numChildren();
            $i = 1;

            while ($i <= $itemCount) {
                $item = 'item' . $i;
                $id = $database->getReference('cart/' . $userID . '/orders' . '/' . $item . '/id')->getValue();
                if ($id == $idBarang) {
                    $database->getReference('cart/' . $userID . '/orders' . '/' . $item . '/jumlah')->set($kuantitas);
                    $total = $this->calculateTotalPrice($userID);
                    $database->getReference('cart/' . $userID . '/total')->set($total);
                }
                $i++;
            }

            return redirect('/pesanan');
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    private function calculateTotalPrice($userID)
    {
        try {

            $database = app('firebase.database');
            $total = 0;
            $itemCount = $database->getReference('cart/' . $userID . '/orders')->getSnapshot()->numChildren();
            $i = 1;
            while ($i <= $itemCount) {
                $pricePerItem = $database->getReference('cart/' . $userID . '/orders' . '/item' . $i . '/harga')->getValue();
                $quantityPerItem = $database->getReference('cart/' . $userID . '/orders' . '/item' . $i . '/jumlah')->getValue();
                $currentTotal = $pricePerItem * $quantityPerItem;
                $total += $currentTotal;
                $i++;
            }

            return $total;
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    private function calculteDistance($from, $to)
    {
        try {

            $apiKey = env('GOOGLE_MAPS_API_KEY');

            $client = new Client();

            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&key=$apiKey";

            $response = $client->get($url);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                $distance = $data['rows'][0]['elements'][0]['distance']['value'];
                return $distance;
            } else {
                return back()->withErrors(['error2' => 'Failed to calculate distance.']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    private function ongkir($origin, $destination)
    {
        try {

            $apiKey = env('GOOGLE_MAPS_API_KEY');

            $client = new Client();

            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&key=$apiKey";

            $response = $client->get($url);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                $distance = $data['rows'][0]['elements'][0]['distance']['value'];
                $ongkir = 0;
                if ($distance > 1000 && $distance < 1500) {
                    return $ongkir = 6000;
                } elseif ($distance < 1000) {
                    return $ongkir = 4000;
                } elseif ($distance > 1500 && $distance <= 2000) {
                    return $ongkir = 8000;
                } else {
                    return back()->with('error2', 'Your distance is to far max 2km');
                }
            } else {
                return back()->withErrors(['error2' => 'Failed to calculate distance.']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    // Temporary function, should be moved to another controller.
    public function checkout()
    {
        try {
            if (request()->selected_address_id != null) {
                $id = request()->selected_address_id;
                $userID = Auth::user()->id;
                $alamat = User::find($userID);
                $database = app('firebase.database');
                $carts = $database->getReference('cart/' . $userID . '/orders')->getValue();
                $total = $database->getReference('cart/' . $userID . '/total')->getValue();
                $idumkm = $database->getReference('cart/' . $userID . '/orders/item1/umkm_id')->getValue();
                $namaUMKM = Data_umkm::find($idumkm);
                $geoUmkm = Data_umkm::find($idumkm)->geo;
                $geoUser = $alamat->addresses()->where('id', $id)->first()->geo;
                $ongkir = $this->ongkir($geoUmkm, $geoUser);
                $jarak = $this->calculteDistance($geoUmkm, $geoUser);
                $database->getReference('cart/' . $userID . '/cust_address')->set($alamat->addresses()->where('id', $id)->first()->address);
                $database->getReference('cart/' . $userID . '/cust_link_address')->set($alamat->addresses()->where('id', $id)->first()->link);
                $database->getReference('cart/' . $userID . '/umkm_address')->set(Data_umkm::find($idumkm)->alamat);
                $database->getReference('cart/' . $userID . '/umkm_link_address')->set(Data_umkm::find($idumkm)->link);
                $database->getReference('cart/' . $userID . '/ongkir')->set($ongkir);
                $database->getReference('cart/' . $userID . '/jarak')->set($jarak);
                return view('pages.Users.CheckoutPage', [
                    'Title' => 'Checkout',
                    'NavPesanan' => 'Checkout',
                    'carts' => $carts,
                    'total' => $total,
                    'nama_umkm' => $namaUMKM->nama_umkm,
                    'ongkir' => $ongkir,
                    // 'AddressList' => PesananModel::alamatUser(),
                    'PengaturanAkun' => HomeModel::pengaturanAkun(),
                    'SeputarDkampus' => HomeModel::seputarDkampus(),
                ]);
            } else {
                return redirect()->back()->with('error2', 'please select the address first');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'You Dont Have Any Orders');
        }
    }

    public function confirmPay()
    {
        try {
            $userID = Auth::user()->id;
            $orderID = hash('sha256', $userID . time());
            $database = app('firebase.database');
            $database->getReference('cart/' . $userID . '/orderID')->set($orderID);

            $carts = $database->getReference('cart/' . $userID . '/orders')->getValue();
            $total = $database->getReference('cart/' . $userID . '/total')->getValue();
            $ongkir = $database->getReference('cart/' . $userID . '/ongkir')->getValue();
            $idumkm = $database->getReference('cart/' . $userID . '/orders/item1/umkm_id')->getValue();
            $namaUMKM = Data_umkm::find($idumkm);
            return view('pages.Users.Pay', [
                'Title' => 'Pay',
                'orderID' => $orderID,
                'carts' => $carts,
                'total' => $total + $ongkir,
                'nama_umkm' => $namaUMKM->nama_umkm,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Some Error Occured');
        }
    }

    public function order(Request $request)
    {
        try {

            $userID = Auth::user()->id;
            $database = app('firebase.database');

            $request->validate([
                'bukti' => 'required|file|mimes:jpeg,jpg,png,heic|max:2048',
            ]);

            if ($request->file('bukti')->isValid()) {
                $request->file('bukti')->store('payment');
                $order = $database->getReference('cart/' . $userID)->getValue();
                $database->getReference('needToDeliver/' . $userID . '-')->set($order);
                $database->getReference('needToDeliver/' . $userID . '-/status')->set('searching');
                $nama_penerima = Auth::user()->nama_user;
                $idumkm = $database->getReference('cart/' . $userID . '/orders/item1/umkm_id')->getValue();
                $namaUMKM = Data_umkm::find($idumkm)->nama_umkm;
                $database->getReference('needToDeliver/' . $userID . '-/nama_penerima')->set($nama_penerima);
                $database->getReference('needToDeliver/' . $userID . '-/nama_umkm')->set($namaUMKM);
                date_default_timezone_set('Asia/Jakarta');
                $timestamp = date('Y-m-d H:i:s');
                $database->getReference('needToDeliver/' . $userID . '-/timestamp')->set($timestamp);
                $database->getReference('cart/' . $userID)->remove();
                return redirect('/pesanan/status');
            } else {
                return redirect()->back()->withErrors('error2', 'Invalid file uploaded.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $userID = Auth::user()->id;
            $database = app('firebase.database');
            $itemCount = $database->getReference('cart/' . $userID . '/orders')->getSnapshot()->numChildren();
            $menuId = $request->id;
            for ($i = 1; $i <= $itemCount; $i++) {
                $ref = $database->getReference('cart/' . $userID . '/orders' . '/item' . $i . '/id')->getValue();
                if ($ref == $menuId) {
                    $database->getReference('cart/' . $userID . '/orders' . '/item' . $i)->remove();
                    $newItemCount = $database->getReference('cart/' . $userID . '/orders')->getSnapshot()->numChildren();
                    if ($newItemCount == 0) {
                        $database->getReference('cart/' . $userID)->remove();
                    }
                }
            }
            return redirect('/pesanan');
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }
}
