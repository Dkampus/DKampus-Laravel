<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class PromoModel
// extends Model
{
    // use HasFactory;
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

    private static $PromoTerlaris = [
        [
            'Img' => 'geprek.jpg',
            'Discount' => 'diskon.svg',
            'Title' => 'Ayam Geprekasvakalia',
            'PriceDiscount' => 'Rp15.000',
            'PriceOri' => 'Rp30.000',
            'Ratings' => '4.7/350 Rating'
        ],
        [
            'Img' => 'geprek.jpg',
            'Discount' => 'diskon.svg',
            'Title' => 'Ayam Geprekasvakalia',
            'PriceDiscount' => 'Rp15.000',
            'PriceOri' => 'Rp30.000',
            'Ratings' => '4.7/350 Rating'
        ],
        [
            'Img' => 'geprek.jpg',
            'Discount' => 'diskon.svg',
            'Title' => 'Ayam Geprekasvakalia',
            'PriceDiscount' => 'Rp15.000',
            'PriceOri' => 'Rp30.000',
            'Ratings' => '4.7/350 Rating'
        ],
        [
            'Img' => 'geprek.jpg',
            'Discount' => 'diskon.svg',
            'Title' => 'Ayam Geprekasvakalia',
            'PriceDiscount' => 'Rp15.000',
            'PriceOri' => 'Rp30.000',
            'Ratings' => '4.7/350 Rating'
        ]
    ];
    public static function promoTerlaris(){
        return collect(self::$PromoTerlaris);
    }
    public static function promoMakanan(){
        return collect(self::$PromoTerlaris);
    }
    public static function carouselPromo(){
        return collect(self::$CarouselPromo);
    }
}
