<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'id_pembayaran'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_pembayaran');
    }
}
