<?php

namespace App\Http\Controllers;

use App\Models\Data_umkm;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function products(Request $request)
    {
        try {
            $products = Menu::with('data_umkm')->all();

            return response()->json([
                'success' => true,
                'message' => 'List Semua Menu',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menampilkan menu',
                'data' => ''
            ], 400);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // dd($request->all());
        try{
        $findUmkm = Data_umkm::findOrFail($request->nama_umkm);
        Menu::create([
            "data_umkm_id" => $request->nama_umkm,
            "nama_makanan" => $request->nama_makanan,
            "deskripsi" => $request->deskripsi,
            "harga" => $request->harga,
            "rating" => 0,
            "image" => $request->image->store('public/' . $findUmkm->nama_umkm)
        ]);
    } catch (\Exception $e) {
        dd($e);
    }
        return redirect()->back();
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
    public function update(Request $request, Menu $menu)
    {
        try {
            $menu = Menu::findOrFail($menu->id);
            $menu->data_umkm_id = $request->nama_umkm;
            $menu->nama_makanan = $request->nama_makanan;
            $menu->deskripsi = $request->deskripsi;
            $menu->harga = $request->harga;            

            if ($request->hasFile('image')) {
                $menu->image = $request->image->store('public/' . $menu->data_umkm->nama_umkm);
            }

            $menu->update();            
        } catch (\Exception $e) {
            dd($e);
        }
        return redirect()->back()->with('success', 'Data Menu berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        DB::beginTransaction();
        try {
            $MenuCount = Menu::where('data_umkm_id', $menu->data_umkm_id)->count();
            if ($MenuCount == 1) {
                session()->flash('error2', 'Product ' . $menu->nama_makanan . ' Gagal Dihapus, karena UMKM ' . $menu->data_umkm->nama_umkm . ' hanya memiliki 1 product');
            }
            Menu::findOrFail($menu->id)->delete();
            Storage::delete("public/{$menu->data_umkm->nama_umkm}/{$menu->image}");            
            DB::commit();
            session()->flash('success', 'Product ' . $menu->nama_makanan . ' Berhasil Dihapus');
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            session()->flash('error2', 'Product ' . $menu->nama_makanan . ' Gagal Dihapus');
            return redirect()->back();
        }
    }
}
