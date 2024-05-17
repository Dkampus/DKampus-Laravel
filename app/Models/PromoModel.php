<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class PromoModel
// extends Model
{
    // use HasFactory;
    //'minuman', 'jajanan', 'aneka nasi', 'ayam & bebek', 'cepat saji', 'roti', 'bakso & soto', 'bakmie', 'mie', 'sate'
    private static $Category = ['minuman', 'jajanan', 'nasi', 'ayam ', 'bebek', 'fast food', 'roti', 'bakso', 'soto', 'bakmie', 'mie', 'sate'];
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
    private static $UmkmHavePromo = [];

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
            'image_umkm' => Data_umkm::where('id', $menu->data_umkm_id)->first()->logo_umkm,
            'Discount' => $menu->diskon,
            'PriceDiscount' => $menu->harga - ($menu->harga * $menu->diskon / 100),
            'PriceOri' => $menu->harga,
            'Ratings' => $menu->rating,
            'Category' => $menu->category,
        ];
    }
    // Mengembalikan array yang berisi data menu yang didiskon
    return $PromoTerlaris;
}

    private static function getDiscountedSpecialMenus(){
        // Mengambil data dari tabel 'menus' yang memiliki diskon
        $discountedSpecialMenus = Menu::where('diskon', '>', 0)->get();
        $PromoSpecialTerlaris = [];

        foreach ($discountedSpecialMenus as $menu) {
            $PromoSpecialTerlaris[] = [
                'Img' => $menu->image,
                'Discount' => 'diskon.svg',
                'nama_makanan' => $menu->nama_makanan,
                'PriceDiscount' => $menu->harga - ($menu->harga * $menu->diskon / 100),
                'PriceOri' => $menu->harga,
                'Ratings' => $menu->rating,
            ];
        }
        return $discountedSpecialMenus;
    }

    private static function getUmkmHavePromo()
    {
        $menuHavePromo = [];
        foreach (Menu::where('diskon', '>', 0)->get() as $menu) {
            if (!array_key_exists($menu->data_umkm_id, $menuHavePromo)) {
                $menuHavePromo[$menu->data_umkm_id] = $menu;
            }
        }

        $UmkmHavePromo = [];
        foreach ($menuHavePromo as $menu) {
            $UmkmHavePromo[] = [
                'nama_umkm' => Data_umkm::where('id', $menu->data_umkm_id)->first()->nama_umkm,
                'image_umkm' => Data_umkm::where('id', $menu->data_umkm_id)->first()->logo_umkm,
                'Ratings' => Data_umkm::where('id', $menu->data_umkm_id)->first()->rating,
                'Category' => $menu->category,
                'Discount' => $menu->diskon,
            ];
        }
        return $UmkmHavePromo;
    }

    public static function promoTerlaris(){
        self::$PromoTerlaris = self::getDiscountedMenus();
        return collect(self::$PromoTerlaris);
    }

    public static function promoSpecial(){
        self::$PromoTerlaris = self::getDiscountedSpecialMenus();
        return collect(self::$PromoTerlaris);
    }

    public static function promoMakanan(){
        return collect(self::$PromoTerlaris);
    }

    public static function promoUmkm(){
        self::$UmkmHavePromo = self::getUmkmHavePromo();
        return collect(self::$UmkmHavePromo);
    }

    public static function carouselPromo(){
        return collect(self::$CarouselPromo);
    }

    public static function promoCategory(){
        return collect(self::$Category);
    }
}
