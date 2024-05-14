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
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Using Exception Before Log-in so doesn't show an error page
        try {
            $userID = Auth::user()->id;
            $alamat = User::find($userID);
            $database = app('firebase.database');
            $test = $database->getReference('cart/' . $userID . '/orders')->getValue();
            $idumkm = $database->getReference('cart/' . $userID . '/orders/item1/umkm_id')->getValue();
            $namaUMKM = Data_umkm::find($idumkm);
            $listAlamat = $alamat->addresses()->where('user_id', $userID)->get();
            return view('pages.Users.Pesanan', [
                'Title' => 'Pesanan',
                'NavPesanan' => 'Pesanan',
                //"favorites" => Favorit::where('user_id', auth()->user()->id)->get(),
                'data' => $test,
                'namaUMKM' => $namaUMKM->nama_umkm,
                'AddressList' => $listAlamat,
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
                'SeputarDkampus' => HomeModel::seputarDkampus(),
            ]);
        } catch (\Exception $e) {
        }
        return view('pages.Users.Pesanan', [
            'Title' => 'Pesanan',
            'NavPesanan' => 'Pesanan',
            'carts' => "",
            'test' => "",
            'namaUMKM' => null,
            // 'AddressList' => PesananModel::alamatUser(),
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
        ]);
    }

    public function status()
    {
        return view('pages.Users.Status', [
            'Title' => 'Status',
            'NavPesanan' => 'Status',
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
        ]);
    }

    public function StatusOrder($orderID)
    {
        $id = $orderID;
        return view('pages.Users.StatusOrder', [
            'Title' => 'Status Order',
            'NavPesanan' => 'Status Order',
            'id' => $id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function updateQuantity(Request $request)
    {
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
    }

    private function calculateTotalPrice($userID)
    {
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
    }

    private function ongkir($origin, $destination)
    {
        $database = app('firebase.database');

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
                return back()->with('warning', 'Your distance is to far max 2km');
            }
        } else {
            return back()->withErrors(['error' => 'Failed to calculate distance.']);
        }
    }

    // Temporary function, should be moved to another controller.
    public function checkout()
    {
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
        $database->getReference('cart/' . $userID . '/cust_address')->set($alamat->addresses()->where('id', $id)->first()->address);
        $database->getReference('cart/' . $userID . '/cust_link_address')->set($alamat->addresses()->where('id', $id)->first()->link);
        $database->getReference('cart/' . $userID . '/umkm_address')->set(Data_umkm::find($idumkm)->alamat);
        $database->getReference('cart/' . $userID . '/umkm_link_address')->set(Data_umkm::find($idumkm)->link);
        $database->getReference('cart/' . $userID . '/ongkir')->set($ongkir);
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
    }

    public function confirmPay()
    {
        $userID = Auth::user()->id;
        $orderID = hash('sha256', $userID . time());
        $database = app('firebase.database');
        $database->getReference('cart/' . $userID . '/orderID')->set($orderID);

        $carts = $database->getReference('cart/' . $userID . '/orders')->getValue();
        $total = $database->getReference('cart/' . $userID . '/total')->getValue() + 5000;
        $idumkm = $database->getReference('cart/' . $userID . '/orders/item1/umkm_id')->getValue();
        $namaUMKM = Data_umkm::find($idumkm);
        return view('pages.Users.Pay', [
            'Title' => 'Pay',
            'orderID' => $orderID,
            'carts' => $carts,
            'total' => $total,
            'nama_umkm' => $namaUMKM->nama_umkm,
        ]);
    }

    public function order(Request $request)
    {
        $userID = Auth::user()->id;
        $database = app('firebase.database');

        $request->validate([
            'bukti' => 'required|file|mimes:jpeg,jpg|max:2048',
        ]);

        if ($request->file('bukti')->isValid()) {
            //$request->file('fileToUpload')->store('uploads');
            $database->getReference('cart/' . $userID . '/status')->set('searching');
            $order = $database->getReference('cart/' . $userID)->getValue();
            $database->getReference('needToDeliver/' . $userID . '-')->set($order);
            $nama_penerima = Auth::user()->nama_user;
            $idumkm = $database->getReference('cart/' . $userID . '/orders/item1/umkm_id')->getValue();
            $namaUMKM = Data_umkm::find($idumkm)->nama_umkm;
            $database->getReference('needToDeliver/' . $userID . '-/nama_penerima')->set($nama_penerima);
            $database->getReference('needToDeliver/' . $userID . '-/nama_umkm')->set($namaUMKM);
            $database->getReference('cart/' . $userID)->remove();
            $orderID = $database->getReference('needToDeliver/' . $userID . '/orderID')->getValue();
            return view('pages.Users.StatusOrder', [
                'Title' => 'Status Order',
                'NavPesanan' => 'Status Order',
                'id' => $orderID
            ]);
        } else {

            return back()->withErrors(['bukti' => 'Invalid file uploaded.']);
        }
    }

    //end of temporary function
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
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
    }
}
