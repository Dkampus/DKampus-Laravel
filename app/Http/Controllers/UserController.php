<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;
use App\Models\PromoModel;
use App\Models\DetailWarungModel;


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

    public function detailWarung(){
        return view('pages.DetailWarung',[
            'CardFood' => DetailWarungModel::listMakanan(), 
            'BannerFade' => DetailWarungModel::bannerDetail(),
            'Title' => 'Detail-Warung'
        ]);
    }

    public function detailMakanan(){
        return view('pages.DetailMakanan',[
            'Title' => 'Detail-Makanan',
            'CardFood' => DetailWarungModel::listMakanan(), 
        ]);
    }

    public function promoLayout(){
        return view('layouts.PromoLayout',[
            'Title' => 'Promo',
            'CarouselPromo' => PromoModel::carouselPromo(),
            'NavPromo' => 'Semua'
        ]);
    }

    public function login(){
        return view('pages.Login',[
            'Title' => 'Log in',
        ]);
    }

    public function register(){
        return view('pages.Register',[
            'Title' => 'Register',
        ]);
    }

    public function code_verification(){
        return view('pages.CodeVerification',[
            'Title' => 'Code Verification'
        ]);
    }

    public function input_register(){
        return view('pages.InputRegister',[
            'Title' => 'Pesanan',
        ]);
    }

    public function pesananLayout(){
        return view('layouts.PesananLayout',[
            'Title' => 'Pesanan',
        ]);
    }

    public function proses(){
        return view('pages.Proses',[
            'Title' => 'Pesanan',
            'NavPesanan' => 'Proses',
        ]);
    }

    public function pesanan(){
        return view('pages.Pesanan',[
            'Title' => 'Pesanan',
            'NavPesanan' => 'Pesanan'
        ]);
    }

    public function atur_ulang_kata_sandi(){
        return view('pages.AturUlangKataSandi',[
            'Title' => 'Atur Ulang Kata Sandi',
        ]);
    }

    public function makanan(){
        return view('pages.MakananPage',[
            'Title' => 'Promo',
            'NavPromo' => 'Makanan',
            'CarouselPromo' => PromoModel::carouselPromo(),
        ]);
    }
    public function semua(){
        return view('pages.SemuaPage',[
            'Title' => 'Promo',
            'NavPromo' => 'Semua',
            'PromoTerlarisSlider' => PromoModel::promoTerlaris(),
            'CarouselPromo' => PromoModel::carouselPromo(),
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
