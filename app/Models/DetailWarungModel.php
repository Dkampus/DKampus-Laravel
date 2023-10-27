<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class DetailWarungModel 
// extends Model
{
    // use HasFactory;
    private static $bannerDetail = [
        [
            'Img' => 'ayamGoyeng.jpg'
        ],
        [
            'Img' => 'friedChicken.jpeg'
        ],
        [
            'Img' => 'goyengAyam.jpeg'
        ],
    ];

    private static $cardMakanan = [
        [
            'Img' => 'pahaAyam.jpg',
            'Ratings' => '4.7',
            'Title' => 'Paha Ayam',
            'Price' => 'Rp8.000'
        ],
        [
            'Img' => 'pahaAyam.jpg',
            'Ratings' => '4.7',
            'Title' => 'Paha Ayam',
            'Price' => 'Rp8.000'
        ],
        [
            'Img' => 'pahaAyam.jpg',
            'Ratings' => '4.7',
            'Title' => 'Paha Ayam',
            'Price' => 'Rp8.000'
        ],
        [
            'Img' => 'pahaAyam.jpg',
            'Ratings' => '4.7',
            'Title' => 'Paha Ayam',
            'Price' => 'Rp8.000'
        ],
        [
            'Img' => 'pahaAyam.jpg',
            'Ratings' => '4.7',
            'Title' => 'Paha Ayam',
            'Price' => 'Rp8.000'
        ],
        [
            'Img' => 'pahaAyam.jpg',
            'Ratings' => '4.7',
            'Title' => 'Paha Ayam',
            'Price' => 'Rp8.000'
        ],
    ];

    public static function listMakanan(){
        return collect(self::$cardMakanan);
    }

    public static function bannerDetail(){
        return collect(self::$bannerDetail);
    }
}
