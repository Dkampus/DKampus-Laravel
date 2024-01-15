<?php

namespace App\Http\Controllers;

use App\Models\HomeModel;
use App\Models\Cart;
use App\Models\Favorit;
use App\Models\PesananModel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Using Exception Before Log-in so doesn't show an error page
        try {
            $data = [
            'Title' => 'Keranjang',
            'NavPesanan' => 'Keranjang',
            //"favorites" => Favorit::where('user_id', auth()->user()->id)->get(),
            'carts' => [],
            'AddressList' => PesananModel::alamatUser(),
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
            ];
            $carts = Cart::where("user_id", auth()->user()->id)->get();
            return view('pages.Users.Pesanan',[
                'Title' => 'Pesanan',
                'NavPesanan' => 'Pesanan',
                //"favorites" => Favorit::where('user_id', auth()->user()->id)->get(),
                'carts' => $carts,
                'AddressList' => PesananModel::alamatUser(),
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
                'SeputarDkampus' => HomeModel::seputarDkampus(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('homepage')->with('error', 'An error occurred. Please try again.');
        }

        return view('pages.Users.Pesanan', $data);
    }

    public function status(){
        return view('pages.Users.Status',[
            'Title' => 'Status',
            'NavPesanan' => 'Status',
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
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

    public function updateQuantity(Request $request){
        $carts = Cart::find($request->id);
        $carts->quantity = $request->quantity;
        $carts->save();

        return redirect('/pesanan');
    }

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

        if($carts){
            return redirect()->back()->with('success', 'Menu berhasil dihapus');
        } else {
            return redirect()->back()->with('error2', 'Menu gagal dihapus');
        }
    }   
}
