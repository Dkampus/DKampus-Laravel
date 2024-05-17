<?php

namespace App\Http\Controllers;

use App\Models\Data_umkm;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
        try {
            $keyword = $request->keyword;
            $menus = Menu::where('nama_makanan', 'like', "%{$keyword}%")
                ->with('data_umkm')
                ->get();


            $menus = $menus->map(function ($menu) {
                $menu->nama_umkm = $menu->data_umkm->nama_umkm;
                return $menu;
            });

        return view('pages.Users.SearchPage', [
            'Title' => 'Search ' . $keyword,
            'NavSearch' => 'Search',
            'menus' => $menus,
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            return view('pages.Users.SearchPage', [
                'Title' => 'Search',
                'NavSearch' => 'Search',
                'menus' => $menus,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function simpan($id, Request $request)
    {
        try {
            $userID = Auth::user()->id;
            $database = app('firebase.database');
            $saved = Menu::find($id);
            $idMakanan = $saved->id;
            $umkmID = $saved->data_umkm_id;
            $jumlah = $request->input('quantity');
            $existingUmkmID = $database->getReference('cart/' . $userID . '/orders')->getSnapshot()->exists();
            $postData = [
                'id' => $idMakanan,
                'nama' => $saved->nama_makanan,
                'harga' => $saved->harga,
                'umkm_id' => $umkmID,
                'jumlah' => $jumlah,
                'catatan' => $request->input('catatan')
            ];
            if ($existingUmkmID) {
                $currentUmkmID = $database->getReference('cart/' . $userID . '/orders' . '/item1' . '/umkm_id')->getValue();
                if ($currentUmkmID != $umkmID) {
                    $database->getReference('cart/' . $userID . '/orders')->remove();
                    $database->getReference('cart/' . $userID . '/orders' . '/item1')->set($postData);
                } else {
                    $itemCount = $database->getReference('cart/' . $userID . '/orders')->getSnapshot()->numChildren();
                    $itemNumber = $itemCount + 1;
                    $item = 'item' . $itemNumber;
                    $i = 1;
                    $checkid = $database->getReference('cart/' . $userID . '/orders' . '/item' . $i . '/id')->getValue();
                    while ($i <= $itemCount && $checkid != $id) {
                        $i++;
                        $checkid = $database->getReference('cart/' . $userID . '/orders' . '/item' . $i . '/id')->getValue();
                    }
                    if ($checkid == $id) {
                        $database->getReference('cart/' . $userID . '/orders' . '/item' . $i . '/jumlah')->set($jumlah);
                    } else {
                        $database->getReference('cart/' . $userID . '/orders' . '/' . $item)->set($postData);
                    }
                }
            } else {
                $database->getReference('cart/' . $userID . '/orders' . '/item1')->set($postData);
            }
            $count = $database->getReference('cart/' . $userID . '/orders')->getSnapshot()->numChildren();
            $j = 1;
            $total = 0;
            while ($j <= $count) {
                $pricePerItem = $database->getReference('cart/' . $userID . '/orders' . '/item' . $j . '/harga')->getValue();
                $quantityPerItem = $database->getReference('cart/' . $userID . '/orders' . '/item' . $j . '/jumlah')->getValue();
                $currentTotal = $pricePerItem * $quantityPerItem;
                $total += $currentTotal;
                $j++;
            }
            $postTotal =
                $database->getReference('cart/' . $userID . '/total')->set($total);
            if ($postTotal) {
                $database->getReference('cart/' . $userID . '/alamat')->set(Data_umkm::find($umkmID)->alamat);
                $database->getReference('cart/' . $userID . '/link')->set(Data_umkm::find($umkmID)->link);
                $database->getReference('cart/' . $userID . '/alamatUmkm')->set(Data_umkm::find($umkmID)->link);
                return redirect()->back()->with('status', 'success');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $findUmkm = Data_umkm::find($request->umkm);

        try {


            Menu::create([
                "data_umkm_id" => $findUmkm->id,
                "nama_makanan" => $request->nama_makanan,
                "deskripsi" => $request->deskripsi,
                "harga" => $request->harga,
                "image" => $request->image->store('public'),
                "rating" => 0,
                "promo" => $request->promo,
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
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'edit_nama_makanan' => 'required|string',
            'edit_deskripsi' => 'required|string',
            'edit_harga' => 'required|numeric',
            'edit_promo' => 'nullable|string',
            // Add validation rules for other fields if needed
        ]);

        // Find the Menu item by its ID
        $menu = Menu::findOrFail($id);

        // Update the Menu item with the validated data
        $menu->update([
            'nama_makanan' => $validatedData['edit_nama_makanan'],
            'deskripsi' => $validatedData['edit_deskripsi'],
            'harga' => $validatedData['edit_harga'],
            'promo' => $validatedData['edit_promo'],
            // Update other fields as needed
        ]);

        // Handle file upload if necessary

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Menu item updated successfully.');
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
