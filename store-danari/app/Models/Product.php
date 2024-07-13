<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'stock',
        'description',
        'price',
        'users_id',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productGaleries()
    {
        return $this->hasMany(ProductGalery::class, 'products_id');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'products_id');
    }
}
