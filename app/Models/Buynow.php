<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buynow extends Model
{
    use HasFactory;
    protected $table = 'buy_nows';  // Tambahkan baris ini

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'is_buy',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function productVariant()
    {
        return $this->belongsTo(ProductVariations::class, 'product_variant_id'); 
    }   
}
