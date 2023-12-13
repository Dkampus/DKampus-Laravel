<?php

namespace App\Http\Controllers;
use App\Models\HomeModel;
use App\Models\UntukKamuModel;
use App\Models\Menu;
use App\Models\Data_umkm;
use App\Models\Footer;
use Illuminate\Http\Request;

class UntukKamuController extends Controller
{
    //
    public function UntukKamu(){
        return view('pages.Users.UntukKamu',[
            'Banner' => HomeModel::bannerData(),
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
            'Carousel' => HomeModel::carouselData(),
            'CarouselDesktop' => HomeModel::carouselDesktopData(),
            // 'RekomendasiWarung' => Data_umkm::all(),
            'UntukKamu' => UntukKamuModel::untukKamu(),
            'RekomendasiMakanan' => Menu::take(5)->get(), // tampilkan menu yang 5 pertama (tidak semua)
            'FooterPart1' => Footer::footerPart1(),
            'FooterPart2Beli' => Footer::footerPart2Beli(),
            'FooterPart2Jual' => Footer::footerPart2Jual(),
            'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
            'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
            'Title' => 'Home',
        ]);
    }
}
