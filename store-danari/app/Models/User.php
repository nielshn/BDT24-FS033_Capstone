<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'phone_number',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function address()
    {
        return $this->hasOne(Address::class, 'user_id');
    }


    public function store()
    {
        return $this->hasOne(Store::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'users_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'users_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'users_id');
    }
}
