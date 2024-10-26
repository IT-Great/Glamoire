<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['price_after_discount'];


    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'promo_products', 'promo_id', 'product_id')
            // ->withPivot('discounted_price')
            ;
    }

    // Mutator untuk date_range
    public function setDateRangeAttribute($value)
    {
        $this->attributes['date_range'] = $value; // Simpan range langsung
    }

    // Accessor (opsional) jika Anda ingin menampilkan date_range kembali dalam format string
    public function getDateRangeAttribute($value)
    {
        return $value; // Tampilkan seperti yang ada
    }

    public function tiers()
    {
        return $this->hasMany(PromoTier::class);
    }
}
