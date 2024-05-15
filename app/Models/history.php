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
        'item',
        'harga',
        'ongkir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
