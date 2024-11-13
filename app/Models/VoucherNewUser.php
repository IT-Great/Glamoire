<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherNewUser extends Model
{
    use HasFactory;

    protected $table = 'voucher_new_users';

    protected $fillable = [
        'id',
        'user_id',
        'code',
        'email',
        'is_use',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
