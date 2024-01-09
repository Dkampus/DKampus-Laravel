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
        ],
        'joins' => [
            'menus' => ['data_umkms.id', 'menus.data_umkm_id'],                        
        ],
    ];

    // relation with data_umkm
    public function data_umkm()
    {
        return $this->belongsTo(Data_umkm::class);
    }

}
