<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifyMe extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'email',
        'status',
        'send_at',
    ];
}
