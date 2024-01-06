<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavoritRequest;
use App\Http\Requests\UpdateFavoritRequest;
use App\Models\Favorit;

class FavoritController extends Controller
{

    public function favoritStore($menuId)
    {        
        $data = Favorit::where('user_id', auth()->user()->id)->where('menu_id', $menuId)->first();
        if ($data) {
            $data->delete();
            return response()->json(['success' => 'Berhasil Menghapus Favorit']);
        } else {
            Favorit::create([
                'user_id' => auth()->user()->id,
                'menu_id' => $menuId,
                'data_umkm_id' => null,
            ]);
           return response()->json(['success' => 'Berhasil Menambahkan Favorit']);
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
    public function store(StoreFavoritRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorit $favorit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorit $favorit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoritRequest $request, Favorit $favorit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorit $favorit)
    {
        //
    }
}
