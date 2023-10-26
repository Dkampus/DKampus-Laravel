<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'id_user',
        'id_umkm',
        'id_makanan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function menu()
    {
        return $this->belongsToMany(Menu::class, 'id_makanan');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
