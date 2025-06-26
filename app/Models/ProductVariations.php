<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariations extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variant_type',
        'variant_value',
        'use_variant_image',
        'variant_image',
        'sku',
        'variant_stock',
        'variant_price',
        'weight_variant',
        'variant_expired',
    ];

    protected $nullable = ['variant_image']; // Tambahkan ini

    public function stocks()
    {
        return $this->hasMany(ProductStocks::class, 'variation_id', 'id');
    }

    public function getTotalStockAttribute()
    {
        return $this->variant_stock + $this->stocks->sum('quantity');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Membuat SKU otomatis berdasarkan product SKU dan variant
    public static function boot()
    {
        parent::boot();

        static::creating(function ($variation) {
            $product = $variation->product;
            $variantType = strtoupper(substr($variation->variant_type, 0, 3)); // Ambil 3 huruf dari tipe varian
            $variantValue = strtoupper(substr($variation->variant_value, 0, 3)); // Ambil 3 huruf dari nilai varian

            // Buat SKU dasar
            $baseSku = $product->product_code . '-' . $variantType . '-' . $variantValue;

            // Cek jika SKU sudah ada
            $existingSkuCount = ProductVariations::where('sku', 'like', $baseSku . '%')->count();

            // Jika ada SKU yang sama, tambahkan angka di belakangnya
            $skuSuffix = $existingSkuCount ? '-' . ($existingSkuCount + 1) : '';

            $variation->sku = $baseSku . $skuSuffix;
        });
    }
}
