<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresse extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'address',
        'link',
        'nama_alamat',
        'geo',
        'utama',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
