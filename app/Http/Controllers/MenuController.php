<?php

namespace App\Http\Controllers;

use App\Models\Data_umkm;
use App\Models\Menu;
use Illuminate\Http\Request;

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
        } catch(\Exception $e){
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
