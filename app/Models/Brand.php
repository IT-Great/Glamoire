<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // // Relasi satu brand memiliki banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function productsNewest()
    {
        return $this->hasMany(Product::class)->orderBy('created_at', 'desc')->limit(10);
    }

    public function productsTop()
    {
        return $this->hasMany(Product::class)->orderBy('sale', 'desc')->limit(10);
    }


    // public function products()
    // {
    //     return $this->belongsToMany(Product::class)
    //         ->withPivot('discount_type', 'discount_value')
    //         ->withTimestamps();
    // }
}
