<?php

namespace App\Http\Controllers;

use App\Models\HomeModel;
use App\Models\Cart;
use App\Models\Favorit;
use App\Models\PesananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Data_umkm;

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
            $database = app('firebase.database');
            $test = $database->getReference('cart/' . $userID . '/orders')->getValue();
            $idumkm = $database->getReference('cart/' . $userID . '/orders/item1/umkm_id')->getValue();
            $namaUMKM = Data_umkm::find($idumkm);
            $carts = Cart::where("user_id", auth()->user()->id)->get();
            return view('pages.Users.Pesanan', [
                'Title' => 'Pesanan',
                'NavPesanan' => 'Pesanan',
                //"favorites" => Favorit::where('user_id', auth()->user()->id)->get(),
                'carts' => $carts,
                'test' => $test,
                'namaUMKM' => $namaUMKM->nama_umkm,
                'AddressList' => PesananModel::alamatUser(),
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
                'SeputarDkampus' => HomeModel::seputarDkampus(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('homepage')->with('error', 'An error occurred. Please try again.');
        }

        return view('pages.Users.Pesanan');
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
    public function store(Request $request)
    {
        $carts = $request->validate([
            'menu_id' => 'required',
            'quantity' => 'required|max:255',
            'catatan' => 'nullable'
        ]);

        $carts['user_id'] = auth()->user()->id;
        Cart::create($carts);

        return redirect('/pesanan');
    }

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
                // return response()->json([
                //     'kuantitas_baru' => $kuantitasBaru,
                //     'totalHarga' => $total,
                // ]);
                // break;
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

    // Temporary function, should be moved to another controller.
    public function checkout()
    {
        $userID = Auth::user()->id;
        $database = app('firebase.database');
        $carts = $database->getReference('cart/' . $userID . '/orders')->getValue();
        $total = $database->getReference('cart/' . $userID . '/total')->getValue();
        $idumkm = $database->getReference('cart/' . $userID . '/orders/item1/umkm_id')->getValue();
        $namaUMKM = Data_umkm::find($idumkm);

        return view('pages.Users.CheckoutPage', [
            'Title' => 'Checkout',
            'NavPesanan' => 'Checkout',
            'carts' => $carts,
            'total' => $total,
            'nama_umkm' => $namaUMKM->nama_umkm,
            'AddressList' => PesananModel::alamatUser(),
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
        ]);
    }
    public function pay($orderID)
    {
        $userID = Auth::user()->id;

        $database = app('firebase.database');
        $carts = $database->getReference('cart/' . $userID . '/orders')->getValue();
        $total = $database->getReference('cart/' . $userID . '/total')->getValue();
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
        $carts = Cart::find($request->id);
        $carts->delete();

        if ($carts) {
            return redirect()->back()->with('success', 'Menu berhasil dihapus');
        } else {
            return redirect()->back()->with('error2', 'Menu gagal dihapus');
        }
    }
}
