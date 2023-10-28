<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'cart_id',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function orderDetail()
    {
        return $this->hasOne(OrderDetail::class);
    }
}
