<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cart_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'is_choose',
        'product_variant_id',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }   

    public function productVariant()
    {
        return $this->belongsTo(ProductVariations::class, 'product_variant_id'); 
    }   
}

