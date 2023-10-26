<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_makanan',
        'deskripsi',
        'harga',
        'rating'
    ];

    public function data_umkm()
    {
        return $this->belongsTo(Data_umkm::class, 'id_umkm');
    }
}
