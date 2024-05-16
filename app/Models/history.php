<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'user_id',
        'cour_id',
        'umkm_id',
        'item',
        'harga',
        'ongkir',

    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courier()
    {
        return $this->belongsTo(User::class, 'cour_id');
    }

    public function umkm()
    {
        return $this->belongsToMany(Data_umkm::class, 'umkm_id');
    }
}
