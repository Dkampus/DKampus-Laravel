<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\GenUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'role',
        'no_telp',
        'fcm_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function data_umkm()
    {
        return $this->hasMany(Data_umkm::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }
    public function favorit()
    {
        return $this->hasMany(Favorit::class);
    }
    public function addresses()
    {
        return $this->hasMany(Addresse::class, 'user_id');
    }
    public function custHistory()
    {
        return $this->hasMany(history::class, 'user_id');
    }
    public function courHistory()
    {
        return $this->hasMany(history::class, 'cour_id');
    }
}
