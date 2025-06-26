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

    protected $appends = ['has_active_promo', 'active_promo_details'];


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
        return $this->belongsToMany(Promo::class, 'promo_products', 'product_id', 'promo_id')
            ->withPivot('discounted_price', 'discount_product_voucher_item', 'discount_type');
    }

    public function productVariations()
    {
        return $this->hasMany(ProductVariations::class);
    }

    public function ratingAndReviews()
    {
        return $this->hasMany(RatingAndReview::class);
    }

    public function getHasActivePromoAttribute()
    {
        return $this->getActivePromo() !== null;
    }

    public function hasActivePromoByType($promoType)
    {
        $currentDate = now()->format('Y-m-d');

        return $this->promos()
            ->where('type', $promoType)
            ->where(function ($query) use ($currentDate) {
                $query->whereRaw("SUBSTRING_INDEX(date_range, ' - ', 1) <= ?", [$currentDate])
                    ->whereRaw("SUBSTRING_INDEX(date_range, ' - ', -1) >= ?", [$currentDate]);
            })
            ->exists();
    }

    public function getActivePromoByType($promoType)
    {
        $currentDate = now()->format('Y-m-d');

        return $this->promos()
            ->where('type', $promoType)
            ->where(function ($query) use ($currentDate) {
                $query->whereRaw("SUBSTRING_INDEX(date_range, ' - ', 1) <= ?", [$currentDate])
                    ->whereRaw("SUBSTRING_INDEX(date_range, ' - ', -1) >= ?", [$currentDate]);
            })
            ->first();
    }

    public function getActivePromoDetailsAttribute()
    {
        $activePromo = $this->getActivePromo();
        if (!$activePromo) {
            return null;
        }

        return [
            'promo_name' => $activePromo->promo_name,
            'promo_type' => $activePromo->type,
            'discount_type' => $activePromo->pivot->discount_type,
            'discount_value' => $activePromo->pivot->discount_product_voucher_item,
            'discounted_price' => $activePromo->pivot->discounted_price,
            'end_date' => explode(' - ', $activePromo->date_range)[1] ?? null
        ];
    }

    public function getActivePromo()
    {
        $currentDate = now()->format('Y-m-d');

        return $this->promos()
            ->where(function ($query) use ($currentDate) {
                $query->whereRaw("SUBSTRING_INDEX(date_range, ' - ', 1) <= ?", [$currentDate])
                    ->whereRaw("SUBSTRING_INDEX(date_range, ' - ', -1) >= ?", [$currentDate]);
            })
            ->first();
    }

    public function getCurrentDiscountedPrice()
    {
        $activePromo = $this->getActivePromo();
        if (!$activePromo) {
            return $this->regular_price;
        }

        return $activePromo->pivot->discounted_price ?? $this->regular_price;
    }

    public function stocks()
    {
        return $this->hasMany(ProductStocks::class);
    }

    public function isInitialStock()
    {
        return $this->stocks()->count() === 0;
    }

    public function getTotalStockAttribute()
    {
        // Total stok langsung mengacu pada stock_quantity
        return $this->stock_quantity;
    }
}
