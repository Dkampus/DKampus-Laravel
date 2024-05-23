<?php

namespace App\Http\Controllers;

use App\Models\Data_umkm;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Exception;

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
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
                'catatan' => $request->input('catatan') ?? "-"
            ];

            if ($existingUmkmID) {
                $items = $database->getReference('cart/' . $userID . '/orders')->getValue();
                $itemKeys = array_keys($items);
                $currentUmkmID = $items[$itemKeys[0]]['umkm_id'];

                if ($currentUmkmID != $umkmID) {
                    $database->getReference('cart/' . $userID . '/orders')->remove();
                    $database->getReference('cart/' . $userID . '/orders/item1')->set($postData);
                } else {
                    $itemExists = false;
                    foreach ($items as $key => $item) {
                        if ($item['id'] == $idMakanan) {
                            $database->getReference('cart/' . $userID . '/orders/' . $key . '/jumlah')->set($jumlah);
                            $itemExists = true;
                            break;
                        }
                    }

                    if (!$itemExists) {
                        $newItemNumber = $this->findNextAvailableItemNumber($items);
                        $itemKey = 'item' . $newItemNumber;
                        $database->getReference('cart/' . $userID . '/orders/' . $itemKey)->set($postData);
                    }
                }
            } else {
                $database->getReference('cart/' . $userID . '/orders/item1')->set($postData);
            }

            $total = $this->calculateTotalPrice($userID);
            $database->getReference('cart/' . $userID . '/total')->set($total);
            $database->getReference('cart/' . $userID . '/umkm_address')->set(Data_umkm::find($umkmID)->alamat);
            $database->getReference('cart/' . $userID . '/umkm_link_address')->set(Data_umkm::find($umkmID)->link);

            return redirect()->back()->with('status', 'success');
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    private function findNextAvailableItemNumber($items)
    {
        $existingNumbers = array_map(function ($key) {
            return intval(str_replace('item', '', $key));
        }, array_keys($items));

        $i = 1;
        while (in_array($i, $existingNumbers)) {
            $i++;
        }
        return $i;
    }

    private function calculateTotalPrice($userID)
    {
        try {
            $database = app('firebase.database');
            $total = 0;
            $items = $database->getReference('cart/' . $userID . '/orders')->getValue();

            if ($items) {
                foreach ($items as $item) {
                    $pricePerItem = $item['harga'];
                    $quantityPerItem = $item['jumlah'];
                    $total += $pricePerItem * $quantityPerItem;
                }
            }

            return $total;
        } catch (Exception $e) {
            return 0;
        }
    }

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
                "category" => $request->category,
            ]);
            return redirect()->back()->with('success', 'Menu stored successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Failed to store the menu.');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'edit_nama_makanan' => 'required|string',
            'edit_deskripsi' => 'required|string',
            'edit_harga' => 'required|numeric',
            'edit_promo' => 'nullable|string',
            'edit_category' => 'required|string',
        ]);

        $menu = Menu::findOrFail($id);

        $menu->update([
            'nama_makanan' => $validatedData['edit_nama_makanan'],
            'deskripsi' => $validatedData['edit_deskripsi'],
            'harga' => $validatedData['edit_harga'],
            'promo' => $validatedData['edit_promo'],
            'category' => $validatedData['edit_category'],
        ]);

        return redirect()->back()->with('success', 'Menu item updated successfully.');
    }

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
