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
    public static function carouselPromo(){
        return collect(self::$CarouselPromo);
    } 
}
