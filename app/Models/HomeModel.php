<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

class HomeModel 
//extends Model
{
    //use HasFactory;
    private static $Banner = [
        [
            'Img' => 'banner.jpg'
        ],
        [
            'Img' => 'banner.jpg'
        ],
        [
            'Img' => 'banner.jpg'
        ],
    ];

    private static $Carousel = [
        [
            'Icon' => 'ramen.svg',
            'Title' => 'Makanan'
        ],
        [
            'Icon' => 'coke.svg',
            'Title' => 'Minuman'
        ],
        [
            'Icon' => 'breakfast.svg',
            'Title' => 'Roti'
        ],
        [
            'Icon' => 'cookies.svg',
            'Title' => 'Biskuit'
        ],
        [
            'Icon' => 'fries.svg',
            'Title' => 'Cemilan'
        ],
    ];

    private static $rekomendasiWarung = [
        [
            'Img' => 'bagdhag.jpg',
            'IconTime' => 'clock.svg',
            'Time' => '09:00 - 21:00',
            'Title' => 'Ayam Goreng Baghdad',
            'MarkPromo' => 'promoMark.svg'
        ],
        [
            'Img' => 'warmingUp.svg',
            'IconTime' => 'clock.svg',
            'Time' => '09:00 - 21:00',
            'Title' => 'WarmingUP - Ko+Lab',
            'MarkPromo' => 'promoMark.svg'
        ],
        [
            'Img' => 'tehpoci.jpg',
            'IconTime' => 'clock.svg',
            'Time' => '09:00 - 21:00',
            'Title' => 'Es Teh Poci',
            'MarkPromo' => 'promoMark.svg'
        ],
        [
            'Img' => 'bagdhag.jpg',
            'IconTime' => 'clock.svg',
            'Time' => '09:00 - 21:00',
            'Title' => 'Ayam Goreng Baghdad',
            'MarkPromo' => 'promoMark.svg'
        ],
        [
            'Img' => 'bagdhag.jpg',
            'IconTime' => 'clock.svg',
            'Time' => '09:00 - 21:00',
            'Title' => 'Ayam Goreng Baghdad',
            'MarkPromo' => 'promoMark.svg'
        ]
    ];

    private static $rekomendasiMakanan = [
        [
            'Img' => 'geprek.jpg',
            'Title' => 'Ayam Geprekasvakelia',
            'Warung' => 'Warung Ayam Geprek',
            'Ratings' => '4.7/350 rating',
            'Price' => 'Rp15.000'
        ],
        [
            'Img' => 'geprek.jpg',
            'Title' => 'Ayam Geprekasvakelia',
            'Warung' => 'Warung Ayam Geprek',
            'Ratings' => '4.7/350 rating',
            'Price' => 'Rp15.000'
        ],
        [
            'Img' => 'geprek.jpg',
            'Title' => 'Ayam Geprekasvakelia',
            'Warung' => 'Warung Ayam Geprek',
            'Ratings' => '4.7/350 rating',
            'Price' => 'Rp15.000'
        ],
        [
            'Img' => 'geprek.jpg',
            'Title' => 'Ayam Geprekasvakelia',
            'Warung' => 'Warung Ayam Geprek',
            'Ratings' => '4.7/350 rating',
            'Price' => 'Rp15.000'
        ]
    ];

    private static $pengaturanAkun = [
        [
            'Icon' => 'daftarAlamat.svg',
            'Title' => 'Daftar Alamat',
            'Desc' => 'Atur daftar alamat anda',
            'Url' => '/daftar-alamat'
        ],
        [
            'Icon' => 'ubahKataSandi.svg',
            'Title' => 'Ubah Kata Sandi',
            'Desc' => 'Amankan akun dengan mengganti kata sandi.',
            'Url' => '/ubah-kata-sandi'
        ],
        [
            'Icon' => 'bersihkanCache.svg',
            'Title' => 'Bersihkan Cache',
            'Desc' => 'Menghapus data sementara untuk meningkatkan kinerja.',
            'Url' => '/bersihkan-cache'
        ],
    ];

    private static $seputarDkampus = [
        [
            'Icon' => 'tentangKami.svg',
            'Title' => 'Tentang Kami',
            'Desc' => 'Ayo! lebih kenal kami',
            'Url' => '/tentang-kami'
        ],
        [
            'Icon' => 'syaratKetentuan.svg',
            'Title' => 'Syarat dan Ketentuan',
            'Desc' => 'Syarat dan ketentuan adalah peraturan yang harus diikuti oleh pengguna kami',
            'Url' => '/syarat-ketentuan'
        ],
        [
            'Icon' => 'ulasan.svg',
            'Title' => 'Beri Kami Ulasan',
            'Desc' => 'Bagikan pendapat Anda dengan memberikan ulasan.',
            'Url' => '/beri-ulasan'
        ],
    ];

    public static function carouselData(){
        return collect(self::$Carousel);
    }

    public static function pengaturanAkun(){
        return collect(self::$pengaturanAkun);
    }

    public static function seputarDkampus(){
        return collect(self::$seputarDkampus);
    }

    public static function bannerData(){
        return collect(self::$Banner);
    }
    
    public static function rekomendasiWarung(){
        return collect(self::$rekomendasiWarung);
    }

    public static function rekomendasiMakanan(){
        return collect(self::$rekomendasiMakanan);
    }

    
}
