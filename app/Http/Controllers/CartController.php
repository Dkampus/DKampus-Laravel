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
use App\Models\Footer;

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
                $item = $database->getReference('cart/' . $userID . '/orders')->getChildKeys();
                $idumkm = $database->getReference('cart/' . $userID . '/orders' . '/' . $item[0] . '/umkm_id')->getValue();
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
                'alamatUtama' => null,
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
                'SeputarDkampus' => HomeModel::seputarDkampus(),
            ]);
        }
    }

    public function status()
    {
        try {
            $userID = Auth::user()->id;
            $data = User::find($userID)->custHistory;
            foreach ($data as $history) {
                $dataCustId[] = $history->user_id;
                $dataCourId[] = $history->cour_id;
                $namaUmkm[] = $history->umkm_id == 0 ? "Jastip" : Data_umkm::find($history->umkm_id)->nama_umkm;
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
            $courId = $request->input('courId');
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
                    'courId' => $courId,
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
                    $nama_umkm = $history->umkm_id == 0 ? "Jastip" : Data_umkm::find($history->umkm_id)->nama_umkm;
                    $nama_driver = User::find($courId)->nama_user;

                    return view('pages.Users.StatusOrder', [
                        'Title' => 'Detail Order',
                        'NavPesanan' => 'Detail Order',
                        'id' => $custId,
                        'orderId' => $history->order_id,
                        'status' => $history->status,
                        'subTotal' => $history->harga,
                        'ongkir' => $history->ongkir,
                        'total' => $history->ongkir + $history->harga,
                        'nama_umkm' => $nama_umkm,
                        'nama_driver' => $nama_driver,
                        'orders' => null,
                        'items' => $history->item,
                    ]);
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function updateQuantity(Request $request)
    {
        try {
            $userID = Auth::user()->id;
            $idBarang = $request->id;
            $database = app('firebase.database');

            $kuantitas = $request->quantity;
            $items = $database->getReference('cart/' . $userID . '/orders')->getChildKeys();
            $itemCount = $database->getReference('cart/' . $userID . '/orders')->getSnapshot()->numChildren();

            for ($i = 0; $i < $itemCount; $i++) {
                $id = $database->getReference('cart/' . $userID . '/orders/' . $items[$i] . '/id')->getValue();
                if ($id == $idBarang) {
                    $database->getReference('cart/' . $userID . '/orders/' . $items[$i] . '/jumlah')->set($kuantitas);
                    $total = $this->calculateTotalPrice($userID);
                    $database->getReference('cart/' . $userID . '/total')->set($total);
                    break;
                }
            }
            $total = $this->calculateTotalPrice($userID);
            return response()->json(['success' => true, 'total' => $total]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    private function calculateTotalPrice($userID)
    {
        try {
            $database = app('firebase.database');
            $total = 0;
            $items = $database->getReference('cart/' . $userID . '/orders')->getValue();

            foreach ($items as $item) {
                $pricePerItem = $item['harga'];
                $quantityPerItem = $item['jumlah'];
                $currentTotal = $pricePerItem * $quantityPerItem;
                $total += $currentTotal;
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
                } elseif ($distance < 1000 && $distance > 0) {
                    return $ongkir = 4000;
                } elseif ($distance > 1500 && $distance <= 2000) {
                    return $ongkir = 8000;
                } else {
                    return redirect()->back()->with('error2', 'Your distance is to far max 2km');
                }
            } else {
                return redirect()->back()->with('error2', 'Failed to calculate distance.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    // Temporary function, should be moved to another controller.
    public function checkout()
    {
        try {
            $userID = Auth::user()->id;
            $database = app('firebase.database');
            if ($database->getReference('onProgress')->getSnapshot()->exists() && $database->getReference('onProgress')->getSnapshot()->hasChildren()) {
                $refId = $database->getReference('onProgress')->getChildKeys();
                foreach ($refId as $id) {
                    $parts = explode("-", $id);
                    $courId = $parts[1];
                    $refOP = $database->getReference('onProgress/' . $userID . '-' . $courId)->getSnapshot()->exists();
                    $refNTD = $database->getReference('needToDeliver/' . $userID . '-')->getSnapshot()->exists();
                    if (!$refNTD && !$refOP) {
                        if (request()->selected_address_id != null) {
                            $id = request()->selected_address_id;
                            $alamat = User::find($userID);
                            $carts = $database->getReference('cart/' . $userID . '/orders')->getValue();
                            $total = $database->getReference('cart/' . $userID . '/total')->getValue();
                            $item = $database->getReference('cart/' . $userID . '/orders')->getChildKeys();
                            $idumkm = $database->getReference('cart/' . $userID . '/orders' . '/' . $item[0] . '/umkm_id')->getValue();
                            $namaUMKM = Data_umkm::find($idumkm);
                            $geoUmkm = Data_umkm::find($idumkm)->geo;
                            $geoUser = $alamat->addresses()->where('id', $id)->first()->geo;
                            $notesAlamat = $alamat->addresses()->where('id', $id)->first()->notes;
                            $ongkir = $this->ongkir($geoUmkm, $geoUser);
                            if (is_numeric($ongkir)) {
                                $jarak = $this->calculteDistance($geoUmkm, $geoUser);
                                $database->getReference('cart/' . $userID . '/cust_address')->set($alamat->addresses()->where('id', $id)->first()->address);
                                $database->getReference('cart/' . $userID . '/cust_link_address')->set($alamat->addresses()->where('id', $id)->first()->link);
                                $database->getReference('cart/' . $userID . '/umkm_address')->set(Data_umkm::find($idumkm)->alamat);
                                $database->getReference('cart/' . $userID . '/umkm_link_address')->set(Data_umkm::find($idumkm)->link);
                                $database->getReference('cart/' . $userID . '/ongkir')->set($ongkir);
                                $database->getReference('cart/' . $userID . '/jarak')->set($jarak);
                                $database->getReference('cart/' . $userID . '/notesAlamat')->set($notesAlamat);
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
                                return redirect()->back()->with('error2', 'Your Distance Is To Far Max 2KM');
                            }
                        } else {
                            return redirect()->back()->with('error2', 'please select the address first');
                        }
                    } else {
                        return redirect()->back()->with('error2', "you already have an order that isn't complete");
                    }
                }
            } else {
                $refNTD = $database->getReference('needToDeliver/' . $userID . '-')->getSnapshot()->exists();
                if (!$refNTD) {
                    if (request()->selected_address_id != null) {
                        $id = request()->selected_address_id;
                        $alamat = User::find($userID);
                        $carts = $database->getReference('cart/' . $userID . '/orders')->getValue();
                        $total = $database->getReference('cart/' . $userID . '/total')->getValue();
                        $item = $database->getReference('cart/' . $userID . '/orders')->getChildKeys();
                        $idumkm = $database->getReference('cart/' . $userID . '/orders' . '/' . $item[0] . '/umkm_id')->getValue();
                        $namaUMKM = Data_umkm::find($idumkm);
                        $geoUmkm = Data_umkm::find($idumkm)->geo;
                        $geoUser = $alamat->addresses()->where('id', $id)->first()->geo;
                        $notesAlamat = $alamat->addresses()->where('id', $id)->first()->notes;
                        $ongkir = $this->ongkir($geoUmkm, $geoUser);
                        if (is_numeric($ongkir)) {
                            $jarak = $this->calculteDistance($geoUmkm, $geoUser);
                            $database->getReference('cart/' . $userID . '/cust_address')->set($alamat->addresses()->where('id', $id)->first()->address);
                            $database->getReference('cart/' . $userID . '/cust_link_address')->set($alamat->addresses()->where('id', $id)->first()->link);
                            $database->getReference('cart/' . $userID . '/umkm_address')->set(Data_umkm::find($idumkm)->alamat);
                            $database->getReference('cart/' . $userID . '/umkm_link_address')->set(Data_umkm::find($idumkm)->link);
                            $database->getReference('cart/' . $userID . '/ongkir')->set($ongkir);
                            $database->getReference('cart/' . $userID . '/jarak')->set($jarak);
                            $database->getReference('cart/' . $userID . '/notesAlamat')->set($notesAlamat);
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
                            return redirect()->back()->with('error2', 'Your Distance Is To Far Max 2KM');
                        }
                    } else {
                        return redirect()->back()->with('error2', 'please select the address first');
                    }
                } else {
                    return redirect()->back()->with('error2', "you already have an order that isn't complete");
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', "");
        }
    }

    public function confirmPay()
    {
        try {
            $userID = Auth::user()->id;
            $orderID = hash('sha256', $userID . time());
            $notePesanan = request()->notesPesanan;
            $database = app('firebase.database');
            $database->getReference('cart/' . $userID . '/orderID')->set($orderID);
            $database->getReference('cart/' . $userID . '/notesPesanan')->set($notePesanan);
            $carts = $database->getReference('cart/' . $userID . '/orders')->getValue();
            $total = $database->getReference('cart/' . $userID . '/total')->getValue();
            $ongkir = $database->getReference('cart/' . $userID . '/ongkir')->getValue();
            $item = $database->getReference('cart/' . $userID . '/orders')->getChildKeys();
            $idumkm = $database->getReference('cart/' . $userID . '/orders' . '/' . $item[0] . '/umkm_id')->getValue();
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
                $filePath = $request->file('bukti')->store('/public/payment');
                $fileName = basename($filePath);
                $order = $database->getReference('cart/' . $userID)->getValue();
                if ($order) {
                    $database->getReference('needToDeliver/' . $userID . '-')->set($order);
                    $database->getReference('needToDeliver/' . $userID . '-/status')->set('searching');
                    $nama_penerima = Auth::user()->nama_user;
                    $item = $database->getReference('needToDeliver/' . $userID . '-/orders')->getChildKeys();
                    $idumkm = $database->getReference('needToDeliver/' . $userID . '-/orders' . '/' . $item[0] . '/umkm_id')->getValue();
                    if ($idumkm == 'Jastip') {
                        $namaUMKM = 'Jastip';
                    } else {
                        $namaUMKM = Data_umkm::find($idumkm)->nama_umkm;
                    }
                    $database->getReference('needToDeliver/' . $userID . '-/nama_penerima')->set($nama_penerima);
                    $database->getReference('needToDeliver/' . $userID . '-/nama_umkm')->set($namaUMKM);
                    date_default_timezone_set('Asia/Jakarta');
                    $timestamp = date('Y-m-d H:i:s');
                    $database->getReference('needToDeliver/' . $userID . '-/timestamp')->set($timestamp);
                    $database->getReference('needToDeliver/' . $userID . '-/bukti')->set($fileName);
                    $database->getReference('cart/' . $userID)->remove();
                    return redirect('/pesanan/status');
                } else {
                    return redirect('/jastip')->with('error2', 'Error');
                }
            } else {
                return redirect()->back()->withErrors('error2', 'Invalid file uploaded.');
            }
        } catch (Exception $e) {
            return redirect('/pesanan')->with('error2', 'Error');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $userID = Auth::user()->id;
            $database = app('firebase.database');
            $items = $database->getReference('cart/' . $userID . '/orders')->getValue();

            if ($items) {
                foreach ($items as $key => $item) {
                    if ($item['id'] == $request->id) {
                        $database->getReference('cart/' . $userID . '/orders/' . $key)->remove();
                        break;
                    }
                }

                $remainingItems = $database->getReference('cart/' . $userID . '/orders')->getValue();
                $newTotal = 0;
                if ($remainingItems) {
                    foreach ($remainingItems as $item) {
                        $newTotal += $item['harga'] * $item['jumlah'];
                    }
                    $database->getReference('cart/' . $userID . '/total')->set($newTotal);
                } else {
                    $database->getReference('cart/' . $userID)->remove();
                }
            }

            return redirect('/pesanan');
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function jastip(Request $request)
    {
        try {
            $userID = Auth::user()->id;
            $database = app('firebase.database');
            $idMakanan = '-';
            $umkmID = 'Jastip';
            $alamat = $request->input('alamat');
            $link = $request->input('link');
            $geoUmkm = $request->input('geo');
            $orderID = hash('sha256', $userID . time());
            $warungs = $request->input('warung');
            if (count($warungs) > 1) {
                $umkmCount = count($warungs) - 1;
                $jumlahWarungs = count($warungs);
                $calculatedTotal = 2500 * $umkmCount;
            } else {
                $jumlahWarungs = 1;
                $calculatedTotal = 0;
            }


            $refNTD = $database->getReference('needToDeliver/' . $userID . '-')->getSnapshot()->exists();
            if ($database->getReference('onProgress')->getSnapshot()->exists() && $database->getReference('onProgress')->getSnapshot()->hasChildren()) {
                $refId = $database->getReference('onProgress')->getChildKeys();
                foreach ($refId as $id) {
                    $parts = explode("-", $id);
                    $courId = $parts[1];
                    $refOP = $database->getReference('onProgress/' . $userID . '-' . $courId)->getSnapshot()->exists();
                    $refNTD = $database->getReference('needToDeliver/' . $userID . '-')->getSnapshot()->exists();
                    if (!$refNTD && !$refOP) {
                        $database->getReference('cart/' . $userID . '/orders')->remove();
                        foreach ($warungs as $index => $namaWarung) {
                            $namaMenus = $request->input("nama_menu.$index");
                            $kuantitas = $request->input("kuantitas.$index");
                            if (!empty($namaMenus) && !empty($kuantitas)) {
                                foreach ($namaMenus as $menuIndex => $namaMenu) {
                                    $postData = [
                                        'id' => $idMakanan,
                                        'nama' => $namaMenu,
                                        'umkm_id' => $umkmID,
                                        'harga' => 0,
                                        'jumlah' => $kuantitas[$menuIndex],
                                        'catatan' => $namaWarung,
                                    ];
                                    $ordersRef = $database->getReference('cart/' . $userID . '/orders');
                                    $existingItems = $ordersRef->getSnapshot()->getValue();
                                    $newIndex = is_array($existingItems) ? count($existingItems) + 1 : 1;
                                    $database->getReference('cart/' . $userID . '/orders/item' . ($newIndex))->set($postData);
                                }
                            } else {
                                return redirect()->back()->with('error2', 'Your Field Menu Is Empty');
                            }
                        }
                        if (request()->selected_address_id != null) {
                            $id = request()->selected_address_id;
                            $alamatUser = User::find($userID);
                            $geoUser = $alamatUser->addresses()->where('id', $id)->first()->geo;
                            $notesAlamat = $alamatUser->addresses()->where('id', $id)->first()->notes;
                            $ongkir = $this->ongkir($geoUmkm, $geoUser);
                            $ongkirAkhir = $ongkir + 1000;
                            if (is_numeric($ongkir)) {
                                $jarak = $this->calculteDistance($geoUmkm, $geoUser);
                                $database->getReference('cart/' . $userID . '/cust_address')->set($alamatUser->addresses()->where('id', $id)->first()->address);
                                $database->getReference('cart/' . $userID . '/cust_link_address')->set($alamatUser->addresses()->where('id', $id)->first()->link);
                                $database->getReference('cart/' . $userID . '/jarak')->set($jarak);
                                $database->getReference('cart/' . $userID . '/notesAlamat')->set($notesAlamat);
                                $database->getReference('cart/' . $userID . '/notesPesanan')->set($request->input('catatan'));
                                $database->getReference('cart/' . $userID . '/ongkir')->set($ongkirAkhir);
                                $database->getReference('cart/' . $userID . '/orderID')->set($orderID);
                                $database->getReference('cart/' . $userID . '/total')->set($calculatedTotal);
                                $database->getReference('cart/' . $userID . '/umkm_address')->set($alamat);
                                $database->getReference('cart/' . $userID . '/umkm_link_address')->set($link);
                                $carts = $database->getReference('cart/' . $userID . '/orders')->getValue();
                                $total = $database->getReference('cart/' . $userID . '/total')->getValue();
                                return view('pages.Users.payJastip', [
                                    'Title' => 'Pay',
                                    'orderID' => $orderID,
                                    'carts' => $carts,
                                    'subtotal' => $total,
                                    'umkmCount' => $jumlahWarungs,
                                    'ongkir' => $ongkirAkhir,
                                    'nama_umkm' => "Jastip",
                                ]);
                            } else {
                                return redirect()->back()->with('error2', 'Your Distance Is To Far Max 2KM');
                            }
                        } else {
                            return redirect()->back()->with('error2', 'please select the address first');
                        }
                    }
                }
            } else if (!$refNTD) {
                $database->getReference('cart/' . $userID . '/orders')->remove();
                foreach ($warungs as $index => $namaWarung) {
                    $namaMenus = $request->input("nama_menu")[$index];
                    $kuantitas = $request->input("kuantitas")[$index];
                    if (!empty($namaMenus) && !empty($kuantitas)) {
                        foreach ($namaMenus as $menuIndex => $namaMenu) {
                            $postData = [
                                'id' => $idMakanan,
                                'nama' => $namaMenu,
                                'umkm_id' => $umkmID,
                                'harga' => 0,
                                'jumlah' => $kuantitas[$menuIndex],
                                'catatan' => $namaWarung,
                            ];
                            $ordersRef = $database->getReference('cart/' . $userID . '/orders');
                            $existingItems = $ordersRef->getSnapshot()->getValue();
                            $newIndex = is_array($existingItems) ? count($existingItems) + 1 : 1;
                            $database->getReference('cart/' . $userID . '/orders/item' . ($newIndex))->set($postData);
                        }
                    } else {
                        return redirect()->back()->with('error2', 'Your Field Menu Is Empty');
                    }
                }
                if (request()->selected_address_id != null) {
                    $id = request()->selected_address_id;
                    $alamatUser = User::find($userID);
                    $geoUser = $alamatUser->addresses()->where('id', $id)->first()->geo;
                    $notesAlamat = $alamatUser->addresses()->where('id', $id)->first()->notes;
                    $ongkir = $this->ongkir($geoUmkm, $geoUser);
                    $ongkirAkhir = $ongkir + 1000;
                    if (is_numeric($ongkir)) {
                        $jarak = $this->calculteDistance($geoUmkm, $geoUser);
                        $database->getReference('cart/' . $userID . '/cust_address')->set($alamatUser->addresses()->where('id', $id)->first()->address);
                        $database->getReference('cart/' . $userID . '/cust_link_address')->set($alamatUser->addresses()->where('id', $id)->first()->link);
                        $database->getReference('cart/' . $userID . '/jarak')->set($jarak);
                        $database->getReference('cart/' . $userID . '/notesAlamat')->set($notesAlamat);
                        $database->getReference('cart/' . $userID . '/notesPesanan')->set($request->input('catatan'));
                        $database->getReference('cart/' . $userID . '/ongkir')->set($ongkirAkhir);
                        $database->getReference('cart/' . $userID . '/orderID')->set($orderID);
                        $database->getReference('cart/' . $userID . '/total')->set($calculatedTotal);
                        $database->getReference('cart/' . $userID . '/umkm_address')->set($alamat);
                        $database->getReference('cart/' . $userID . '/umkm_link_address')->set($link);
                        $carts = $database->getReference('cart/' . $userID . '/orders')->getValue();
                        $total = $database->getReference('cart/' . $userID . '/total')->getValue();
                        return view('pages.Users.payJastip', [
                            'Title' => 'Pay',
                            'orderID' => $orderID,
                            'carts' => $carts,
                            'subtotal' => $total,
                            'umkmCount' => $jumlahWarungs,
                            'ongkir' => $ongkirAkhir,
                            'nama_umkm' => "Jastip",
                        ]);
                    } else {
                        return redirect()->back()->with('error2', 'Your Distance Is To Far Max 2KM');
                    }
                } else {
                    return redirect()->back()->with('error2', 'please select the address first');
                }
            } else {
                return redirect()->back()->with('error2', "you already have an order that isn't complete");
            }
            return redirect()->back()->with('status', 'success');
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'error occured');
        }
    }

    public function jastipIndex()
    {
        try {
            $userID = Auth::user()->id;
            $alamat = User::find($userID);
            $listAlamat = $alamat ? $alamat->addresses()->where('user_id', $userID)->get() : null;
            $alamatUtama = $listAlamat ? $listAlamat->where('utama', 1)->first() : null;

            return view('pages.Users.JastipPage', [
                'Title' => 'Jastip',
                'Jastip' => Data_umkm::all(),
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
                'SeputarDkampus' => HomeModel::seputarDkampus(),
                'FooterPart1' => Footer::footerPart1(),
                'AddressList' => $listAlamat,
                'alamatUtama' => $alamatUtama,
            ]);
        } catch (Exception $e) {
            return redirect('/')->with('error2', 'Terjadi kesalahan');
        }
    }
}
