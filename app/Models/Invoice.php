<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice',
    ];

    public function order()
    {
        return $this->belongsTo(order::class, 'order_id');
    }
}
