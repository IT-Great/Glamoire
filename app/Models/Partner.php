<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $table = 'partners';  // Tambahkan baris ini
    protected $fillable = [
        'id',
        'fullname',
        'handphone',
        'email',
        'company_name',
        'description',
        'bpom',
        'distributor',
        'reached_email',
        'category_product',
        'file_company',
        'file_bpom',
        'created_at',
        'updated_at',
    ];

    public function fileCompany()
    {
        return $this->hasOne(File::class, 'id', 'file_company')->where('type', 'company');
    }

    public function fileBpom()
    {
        return $this->hasOne(File::class, 'id', 'file_bpom')->where('type', 'bpom');
    }
}
