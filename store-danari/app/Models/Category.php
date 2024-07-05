<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class, 'categories_id');
    }
}
