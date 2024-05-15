<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class PromoModel
// extends Model
{
    // use HasFactory;
    //'minuman', 'jajanan', 'aneka nasi', 'ayam & bebek', 'cepat saji', 'roti', 'bakso & soto', 'bakmie', 'mie', 'sate'
    private static $Category = ['semua', 'minuman', 'jajanan', 'nasi', 'ayam ', 'bebek', 'fast food', 'roti', 'bakso', 'soto', 'bakmie', 'mie', 'sate'];
    private static $CarouselPromo = [
        [
            'Img' => 'spagetti.jpg',
            'Desc' => 'Terbaru! Ada PROMO Nikmat Bener Puas, Gaskuen!',
            'Warung' => 'Warung Spagetti Tante Ayu'
        ],
        [
            'Img' => 'spagetti.jpg',
            'Desc' => 'Terbaru! Ada PROMO Nikmat Bener Puas, Gaskuen!',
            'Warung' => 'Warung Spagetti Tante Ayu'
        ],
        [
            'Img' => 'spagetti.jpg',
            'Desc' => 'Terbaru! Ada PROMO Nikmat Bener Puas, Gaskuen!',
            'Warung' => 'Warung Spagetti Tante Ayu'
        ],
        [
            'Img' => 'spagetti.jpg',
            'Desc' => 'Terbaru! Ada PROMO Nikmat Bener Puas, Gaskuen!',
            'Warung' => 'Warung Spagetti Tante Ayu'
        ],
        [
            'Img' => 'spagetti.jpg',
            'Desc' => 'Terbaru! Ada PROMO Nikmat Bener Puas, Gaskuen!',
            'Warung' => 'Warung Spagetti Tante Ayu'
        ]
    ];
    private static $PromoTerlaris = [];

    private static function getDiscountedMenus(){
    // Mengambil data dari tabel 'menus' yang memiliki diskon
    $discountedMenus = Menu::where('diskon', '>', 0)->get();

    // Membuat array untuk menyimpan data menu yang didiskon
    $PromoTerlaris = [];

    // Mengisi array dengan data dari setiap menu yang didiskon
    foreach ($discountedMenus as $menu) {
        $PromoTerlaris[] = [
            'Img' => $menu->image,
            'Discount' => 'diskon.svg',
            'nama_makanan' => $menu->nama_makanan,
            'nama_umkm' => Data_umkm::where('id', $menu->data_umkm_id)->first()->nama_umkm,
            'PriceDiscount' => $menu->harga - ($menu->harga * $menu->diskon / 100),
            'PriceOri' => $menu->harga,
            'Ratings' => $menu->rating,
        ];
    }

    // Mengembalikan array yang berisi data menu yang didiskon
    return $PromoTerlaris;
}

    public static function promoTerlaris(){
        self::$PromoTerlaris = self::getDiscountedMenus();
        return collect(self::$PromoTerlaris);
    }
    public static function promoMakanan(){
        return collect(self::$PromoTerlaris);
    }
    public static function carouselPromo(){
        return collect(self::$CarouselPromo);
    }

    public static function promoCategory(){
        return collect(self::$Category);
    }
}
