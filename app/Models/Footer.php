<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer 
//extends Model
{
    // use HasFactory;
    private static $Part1 = [
        [
            'title' => 'Tentang Dkampus',
            'url' => '/tentangDkampus'
        ],  
        [
            'title' => 'Karir',
            'url' => '/karir'
        ],
        [
            'title' => 'Blog Dkampus',
            'url' => '/tentangDkampus'
        ],
        [
            'title' => 'Dkampus Parents',
            'url' => '/dkampusParents'
        ],
        [
            'title' => 'Mitra Blog',
            'url' => '/mitraBlog'
        ],
        [
            'title' => 'Road to Evolusi Lokal',
            'url' => '/roadToEvolusiLokal'
        ],
        [
            'title' => 'Pegawai',
            'url' => '/pegawai'
        ],
        [
            'title' => 'Dkampus Marketing Solutions',
            'url' => '/dkampusMarketingSolutions'
        ],
    ];

    private static $Part2Beli = [
       [
        'title' => 'Makanan UMKM Lokal',
        'url' => '/makananUmkmLokal'
       ],
       [
        'title' => 'Minuman UMKM Lokal',
        'url' => '/minumanUmkmLokal'
       ],
       [
        'title' => 'Cemilan UMKM Lokal',
        'url' => '/cemilanUmkmLokal'
       ],
    ];

    private static $Part2Jual = [
        [
         'title' => 'Pusat UMKM Seller',
         'url' => '/pusatUMKMSeller'
        ],
        [
         'title' => 'Mitra UMKM',
         'url' => '/mitraUmkm'
        ],
        [
         'title' => 'Daftar Official Store',
         'url' => '/daftarOfficialStore'
        ],
     ];

     private static $Part3KeamananDanPrivasi = [
        [
         'img' => 'yellowSecurity.svg',
         'title' => 'Yellow Security',
         'url' => '/yellowSecurity'
        ],
        [
         'img' => 'blueLock.svg',
         'title' => 'BlueLock',
         'url' => '/bluelock'
        ],
        [
         'img' => 'antiBugger.svg',
         'title' => 'AntiBugger',
         'url' => '/antibugger'
        ],
     ];

     private static $Part3IkutiKami = [
        [
         'img' => 'instagram.svg',
         'url' => '/instagram'
        ],
        [
         'img' => 'twitter.svg',
         'url' => '/twitter'
        ],
        [
         'img' => 'tiktok.svg',
         'url' => '/tiktok'
        ],
     ];

    public static function footerPart1(){
        return collect(self::$Part1);
    }

    public static function footerPart2Beli(){
        return collect(self::$Part2Beli);
    }

    public static function footerPart2Jual(){
        return collect(self::$Part2Jual);
    }

    public static function footerPart3KeamananDanPrivasi(){
        return collect(self::$Part3KeamananDanPrivasi);
    }

    public static function footerPart3IkutiKami(){
        return collect(self::$Part3IkutiKami);
    }
}
