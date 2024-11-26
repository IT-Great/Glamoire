<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['formatted_discount', 'all_discount_tiers'];

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
            ->withPivot('discount_product_voucher_item', 'limit_stock');
    }

    public function tiers()
    {
        return $this->hasMany(PromoTier::class);
    }

    // Mutator untuk date_range
    public function setDateRangeAttribute($value)
    {
        $this->attributes['date_range'] = $value;
    }

    public function getDateRangeAttribute($value)
    {
        return $value; // Kembalikan nilai asli dari database
    }

    public function getStartDateAttribute()
    {
        if (!$this->date_range) return null;

        $dates = explode(' - ', $this->date_range);
        return $dates[0] ?? null;
    }

    public function getEndDateAttribute()
    {
        if (!$this->date_range) return null;

        $dates = explode(' - ', $this->date_range);
        return $dates[1] ?? null;
    }

    public function getFormattedDiscountAttribute()
    {
        $firstTier = $this->tiers()->orderBy('tier_level')->first();

        if (!$firstTier) {
            return '-';
        }

        switch ($firstTier->discount_type) { // Gunakan discount_type dari tier
            case 'percentage':
                return $firstTier->discount_value . '%';
            case 'nominal':
                return 'Rp ' . number_format($firstTier->discount_value, 0, ',', '.');
            case 'package':
                return 'Rp ' . number_format($firstTier->package_price, 0, ',', '.') . ' / ' . $firstTier->min_quantity . ' items';
            default:
                return '-';
        }
    }


    public function getAllDiscountTiersAttribute()
    {
        $tiers = $this->tiers()->orderBy('tier_level')->get();
        $result = [];

        foreach ($tiers as $tier) {
            switch ($tier->discount_type) { // Gunakan discount_type dari setiap tier
                case 'percentage':
                    $result[] = "Min Pembelian {$tier->min_quantity} item Discount : {$tier->discount_value}%";
                    break;
                case 'nominal':
                    $result[] = "Min Pembelian {$tier->min_quantity} item Discount : Rp " . number_format($tier->discount_value, 0, ',', '.');
                    break;
                case 'package':
                    $result[] = "Beli {$tier->min_quantity} item Harga : Rp " . number_format($tier->package_price, 0, ',', '.');
                    break;
            }
        }

        return implode('<br>', $result);
    }

    // Tambahan: Method helper untuk mengecek tipe diskon
    public function isPercentageDiscount()
    {
        return $this->discount_type === 'percentage';
    }

    public function isNominalDiscount()
    {
        return $this->discount_type === 'nominal';
    }

    public function isPackageDiscount()
    {
        return $this->discount_type === 'package';
    }

    // Method untuk mendapatkan nilai diskon berdasarkan quantity
    public function getDiscountForQuantity($quantity)
    {
        $applicableTier = $this->tiers()
            ->where('min_quantity', '<=', $quantity)
            ->orderBy('tier_level', 'desc')
            ->first();

        if (!$applicableTier) {
            return 0;
        }

        switch ($applicableTier->discount_type) {
            case 'percentage':
                return $applicableTier->discount_value;
            case 'nominal':
                return $applicableTier->discount_value;
            case 'package':
                return $applicableTier->package_price;
            default:
                return 0;
        }
    }

    public function isActive()
    {
        // Promo aktif jika status = active dan belum expired berdasarkan end_date
        if (!$this->end_date) {
            return false;
        }

        return $this->status === 'active' &&
            \Carbon\Carbon::parse($this->end_date)->isFuture();
    }

    public function togglePromoStatus()
    {
        // Ubah status
        $this->status = $this->status === 'active' ? 'expired' : 'active';

        // Jika status diubah menjadi expired, update end_date menjadi hari ini
        if ($this->status === 'expired') {
            $startDate = \Carbon\Carbon::now()->format('d/m/Y');
            $endDate = \Carbon\Carbon::now()->format('d/m/Y');
            $this->date_range = "{$startDate} - {$endDate}";
        }

        $this->save();
        return $this;
    }

    public function promoProducts()
    {
        return $this->hasMany(PromoProduct::class, 'promo_id');
    }
    
    public function promoTiers()
    {
        return $this->hasManyThrough(
            PromoTier::class,  // Model tujuan
            Promo::class,      // Model perantara
            'product_id',      // Foreign key di tabel promos
            'promo_id',        // Foreign key di tabel promo_tiers
            'id',              // Local key di tabel products
            'id'               // Local key di tabel promos
        );
    }
}
