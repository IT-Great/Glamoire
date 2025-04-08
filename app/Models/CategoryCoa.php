<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCoa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function coa()
    {
        return $this->hasMany(Coa::class, 'coa_category_id');
    }
}
