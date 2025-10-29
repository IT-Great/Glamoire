<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoGiftProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_id',
        'main_product_id',
        'gift_product_id',
        'main_product_quantity',
        'gift_product_quantity',
        'limit_stock',
    ];

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function mainProduct()
    {
        return $this->belongsTo(Product::class, 'main_product_id');
    }

    public function giftProduct()
    {
        return $this->belongsTo(Product::class, 'gift_product_id');
    }
}
