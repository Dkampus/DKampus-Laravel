<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'id_user',
        'id_orderDetail',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
