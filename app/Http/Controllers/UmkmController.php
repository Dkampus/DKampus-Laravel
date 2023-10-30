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
    public function store(Request $request)
    {
        //
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
