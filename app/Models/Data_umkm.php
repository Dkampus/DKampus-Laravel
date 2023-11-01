<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_umkm',
        'logo_umkm',
        'alamat',
        'no_telp_umkm',
        'vip'
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
