<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier_Data extends Model
{
    protected $guarded = ['id'];

    public function invoices()
    {
        return $this->hasMany(Invoice_Supplier::class, 'supplier_id', 'id');
    }
}
