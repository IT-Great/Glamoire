<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(CategoryProduct::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CategoryProduct::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Relasi dengan model Product
    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'category_product_id');
    // }

   
}
