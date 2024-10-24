<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'images' => 'array', // Ini akan mengubah kolom 'images' menjadi array saat diakses
        'dimensions' => 'array', // Untuk kolom dimensions
    ];

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function getImagesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'promo_products', 'product_id', 'promo_id');
    }

    public function productVariations()
    {
        return $this->hasMany(ProductVariations::class);
    }

    public function ratingAndReviews()
    {
        return $this->hasMany(RatingAndReview::class);
    }

    // discount product
    public function applyDiscount($discountPercentage)
    {
        $discountAmount = $this->regular_price * ($discountPercentage / 100);
        $this->discounted_price = $this->regular_price - $discountAmount;
        $this->save();
    }
}
