<?php

namespace App\Http\Controllers;

use App\Models\Data_umkm;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{

    public function allDataUmkm()
    {
        try {
            $allUmkm = Data_umkm::all();

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

    public function shopData(Request $request)
    {

        try {
            $shopData = Data_umkm::where('id', $request->id)->first();

            return response()->json([
                'success' => true,
                'message' => 'Data Toko',
                'data' => $shopData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menampilkan data toko',
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
        try {
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
            // ($request->file('logo_umkm'));
            // Upload dan simpan gambar
            // if ($request->hasFile('logo_umkm')) {
            //     $imagePath = $request->file('logo_umkm')->store('umkm_images', 'public');
            //     $validatedData['logo_umkm'] = $imagePath;
            // }

            // Simpan data Umkm ke database
            // Data_umkm::create($validatedData);

            Data_umkm::create([
                'user_id' => $request->user_id,
                'nama_umkm' => $request->nama_umkm,
                'logo_umkm' => $request->logo_umkm->store('public'),
                'alamat' => $request->alamat,
                'no_telp_umkm' => $request->no_telp_umkm,
                'vip' => $request->vip,
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
        return redirect()->route('umkm')->with('success', 'Data UMKM berhasil ditambahkan');
    }

    public function addProduct(Request $request)
    {
        try {
            $idUmkm = Data_umkm::find($request->umkm)->id;
            $validatedData = $request->validate([
                'umkm' => 'required',
                'nama_makanan' => 'required',
                //'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'deskripsi' => 'required',
                'harga' => 'required',
                //'promo' => 'required',
            ]);
            Menu::create([
                "data_umkm_id" => $idUmkm,
                "nama_makanan" => $request->nama_makanan,
                "deskripsi" => $request->deskripsi,
                "harga" => $request->harga,
                "image" => $request->image->store('public'),
                "rating" => 0,
                "slug" => "",
                "diskon" => $request->promo,
            ]);
            return redirect()->back()->with('success', 'Menu stored successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Failed to store the menu.');
        }
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
    public function update(Request $request, Data_umkm $umkm)
    {
        try {
            $umkm = Data_umkm::findOrFail($umkm->id);

            $umkm->nama_umkm = $request->edit_nama_umkm;
            $umkm->alamat = $request->edit_alamat;
            $umkm->no_telp_umkm = $request->edit_no_telp_umkm;
            $umkm->vip = $request->edit_vip;

            // Check if a new logo is uploaded
            if ($request->hasFile('logo_umkm')) {
                // Store the new logo and update the logo_umkm attribute
                $umkm->logo_umkm = $request->logo_umkm->store('public/' . $umkm->nama_umkm);
            }

            $umkm->save();

            return redirect()->back()->with('success', 'Data UMKM berhasil diupdate');
        } catch (\Exception $e) {
            // Handle any exceptions
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Data_umkm $umkm)
    {
        DB::beginTransaction();
        try {
            Data_umkm::findOrFail($umkm->id)->delete();
            Storage::deleteDirectory("public/{$umkm->nama_umkm}");
            DB::commit();
            session()->flash('success', 'Umkm ' . $umkm->nama_umkm . ' Berhasil Dihapus');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error2', 'Umkm ' . $umkm->nama_umkm . ' Gagal Dihapus');
            return redirect()->back();
        }
    }
}
