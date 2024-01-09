<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Menu extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [
        'id',        
    ];

    protected $searchable = [
        'columns' => [
            'nama_makanan' => 10,            
            'kategori' => 10,
            'deskripsi' => 10, 
            'data_umkms.nama_umkm' => 10,        
        ],
        'joins' => [
            'data_umkms' => ['menus.data_umkm_id', 'data_umkms.id'],                      
        ],
    ];

    // relation with data_umkm
    public function data_umkm()
    {
        return $this->belongsTo(Data_umkm::class);
    }

}
