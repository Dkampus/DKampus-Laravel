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
        $carts = Cart::where("user_id", auth()->user()->id)->get();
        return view('pages.Users.Pesanan',[
            'Title' => 'Pesanan',
            'NavPesanan' => 'Pesanan',
            'carts' => $carts,
            'AddressList' => PesananModel::alamatUser(),
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        ]);
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
        $carts = Cart::create([
            'user_id' => $request->user_id,
            'menu_id' => $request->menu_id,
            'quantity' => $request->quantity,
            'catatan' => $request->catatan
        ]);

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
