<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',        
    ];

    public function data_umkm()
    {
        return $this->belongsTo(Data_umkm::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
