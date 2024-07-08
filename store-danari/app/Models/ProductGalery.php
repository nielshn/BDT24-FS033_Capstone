<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGalery extends Model
{
    use HasFactory;

    protected $fillable = ['products_id', 'photos'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
