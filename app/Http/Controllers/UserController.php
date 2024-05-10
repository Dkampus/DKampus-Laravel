<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Data_umkm;
use App\Models\Menu;
use App\Models\Footer;
use Illuminate\Http\Request;
use App\Models\HomeModel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.Users.Homepage', [
            'Banner' => HomeModel::bannerData(),
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
            'Carousel' => HomeModel::carouselData(),
            'CarouselDesktop' => HomeModel::carouselDesktopData(),
            'RekomendasiWarung' => Data_umkm::all(),
            'RekomendasiMakanan' => Menu::take(5)->get(),
            'FooterPart1' => Footer::footerPart1(),
            'FooterPart2Beli' => Footer::footerPart2Beli(),
            'FooterPart2Jual' => Footer::footerPart2Jual(),
            'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
            'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
            'Title' => 'Home',
        ]);
    }

    public function login()
    {
        return view('pages.Users.Login', [
            'Title' => 'Log in',
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
        ]);
    }

    public function register()
    {
        return view('pages.Users.Register', [
            'Title' => 'Register',
        ]);
    }

    public function daftarAlamat()
    {
        //        $alamat = Auth::user()->alamat; // relation dari model User ?

        //        return view('daftar_alamat', compact('alamat'));
    }

    public function code_verification()
    {
        return view('pages.Users.CodeVerification', [
            'Title' => 'Code Verification'
        ]);
    }

    public function input_register()
    {
        return view('pages.Users.InputRegister', [
            'Title' => 'Pesanan',
        ]);
    }

    public function atur_ulang_kata_sandi()
    {
        return view('pages.Users.AturUlangKataSandi', [
            'Title' => 'Atur Ulang Kata Sandi',
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
