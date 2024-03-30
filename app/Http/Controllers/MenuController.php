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
            $products = Menu::all();

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

    public function search_item(Request $request)
    {
        try {
            $menus = Menu::with('data_umkm')->where('nama_makanan', 'like', '%' . $request->query('query') . '%')->get();


            return response()->json($menus);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
    public function data_umkm()
    {
        return $this->belongsTo(Data_umkm::class);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $menus = Menu::where('nama_makanan', 'like', "%{$keyword}%")
            ->with('data_umkm') // Add this line to get the related UMKM data
            ->get();

        // Transform the menus data to include the UMKM name
        $menus = $menus->map(function ($menu) {
            $menu->nama_umkm = $menu->data_umkm->nama_umkm;
            return $menu;
        });

        return view('pages.Users.SearchPage', [
            'Title' => 'Search',
            'NavSearch' => 'Search',
            'menus' => $menus,
        ]);
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
        DB::beginTransaction();
        try {
            $findUmkm = Data_umkm::findOrFail($request->nama_umkm);
            Menu::create([
                "data_umkm_id" => $request->nama_umkm,
                "nama_makanan" => $request->nama_makanan,
                "deskripsi" => $request->deskripsi,
                "harga" => $request->harga,
                "rating" => 0,
                "promo" => $request->promo,
                "image" => $request->image->storeAs('public/' . $findUmkm->nama_umkm, $request->nama_makanan . '.' . $request->image->extension())
                //temp image
                //"image" => 'default.jpg'
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back();
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
            $menu->promo = $request->promo;
            $menu->harga = $request->harga;

            if ($request->hasFile('image')) {
                Storage::delete("public/{$menu->data_umkm->nama_umkm}/{$menu->image}");
                $menu->image = $request->image->storeAs('public/' . $menu->data_umkm->nama_umkm, $menu->nama_makanan . '.' . $request->image->extension());
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
