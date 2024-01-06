<?php

namespace App\Http\Controllers;

use App\Models\HomeModel;
use App\Models\Cart;
use App\Models\PesananModel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'Title' => 'Keranjang',
            'NavPesanan' => 'Keranjang',
            'carts' =>  [],
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
        ];
        if(auth()->user()->id ?? false){
            $carts = Cart::where("user_id", auth()->user()->id)->get();

            $data =[
                'Title' => 'Pesanan',
                'NavPesanan' => 'Pesanan',
                'carts' => $carts,
                'AddressList' => PesananModel::alamatUser(),
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
            ];
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
