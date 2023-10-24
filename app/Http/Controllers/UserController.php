<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;
use App\Models\PromoModel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        return view('pages.Homepage',[
            'Banner' => HomeModel::bannerData(),
            'Carousel' => HomeModel::carouselData(),
            'RekomendasiWarung' => HomeModel::rekomendasiWarung(),
            'RekomendasiMakanan' => HomeModel::rekomendasiMakanan(),
            'Title' => 'Home'
        ]);
    }

    public function promo(){
        return view('pages.Promopage',[
            'Title' => 'Promo',
            'CarouselPromo' => PromoModel::carouselPromo()
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
