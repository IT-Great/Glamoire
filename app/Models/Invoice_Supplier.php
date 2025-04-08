<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice_Supplier extends Model
{
    protected $guarded = ['id'];

    protected $table = 'invoice_suppliers';

    public function supplier()
    {
        return $this->belongsTo(Supplier_Data::class, 'supplier_id');
    }

    public function transferAccount()
    {
        return $this->belongsTo(Coa::class, 'transfer_account_id');
    }

    public function depositAccount()
    {
        return $this->belongsTo(Coa::class, 'deposit_account_id');
    }

    // Relasi untuk old_transfer_account_id
    public function oldAccount()
    {
        return $this->belongsTo(Coa::class, 'old_transfer_account_id');
    }

    // Relasi untuk new_transfer_account_id
    public function newAccount()
    {
        return $this->belongsTo(Coa::class, 'new_transfer_account_id');
    }
}
