<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_umkm extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
