<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer 
//extends Model
{
    // use HasFactory;
    private static $dkampusPart = [
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

    public static function footerDkampus(){
        return collect(self::$dkampusPart);
    }
}
