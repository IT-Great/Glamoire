<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $table = 'partners';  // Tambahkan baris ini
    protected $guarded = ['id'];

    public function fileCompany()
    {
        return $this->hasOne(File::class, 'id', 'file_company')->where('type', 'company');
    }
}
