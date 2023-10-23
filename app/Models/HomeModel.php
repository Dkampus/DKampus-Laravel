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
            'Title' => 'Ayam Goreng Baghdad'
        ],
        [
            'Img' => 'bagdhag.jpg',
            'IconTime' => 'clock.svg',
            'Time' => '09:00 - 21:00',
            'Title' => 'Ayam Goreng Baghdad'
        ],
        [
            'Img' => 'bagdhag.jpg',
            'IconTime' => 'clock.svg',
            'Time' => '09:00 - 21:00',
            'Title' => 'Ayam Goreng Baghdad'
        ],
        [
            'Img' => 'bagdhag.jpg',
            'IconTime' => 'clock.svg',
            'Time' => '09:00 - 21:00',
            'Title' => 'Ayam Goreng Baghdad'
        ],
        [
            'Img' => 'bagdhag.jpg',
            'IconTime' => 'clock.svg',
            'Time' => '09:00 - 21:00',
            'Title' => 'Ayam Goreng Baghdad'
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
    public static function carouselData(){
        return collect(self::$Carousel);
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
