<?php

namespace App\Http\Controllers;

use App\Models\Data_umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{

    public function allDataUmkm()
    {
        try {
            $allUmkm = Data_umkm::with('menu')->all();

            return response()->json([
                'success' => true,
                'message' => 'List Semua Toko',
                'data' => $allUmkm
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menampilkan Toko',
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
    public function storeUmkm(Request $request)
    {
        // try{
            // Validasi data input
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nama_umkm' => 'required',
            'logo_umkm' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'required',
            'no_telp_umkm' => 'required',
            'vip' => 'required',
        ]);
        // dd
        ($request->file('logo_umkm'));
        // Upload dan simpan gambar
        if ($request->hasFile('logo_umkm')) {
            $imagePath = $request->file('logo_umkm')->store('umkm_images', 'public');
            $validatedData['logo_umkm'] = $imagePath;
        }

        // Simpan data Umkm ke database
        // Data_umkm::create($validatedData);

        Data_umkm::create([
            'user_id' => $request->user_id,
            'nama_umkm' => $request->nama_umkm,
            'logo_umkm' => $request->logo_umkm,
            'alamat' => $request->alamat,
            'no_telp_umkm' => $request->no_telp_umkm,
            'vip' => $request->vip,
        ]);

        // } catch (\Exception $e){
            // dd($e);
        // }
        return redirect()->route('umkm');
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
