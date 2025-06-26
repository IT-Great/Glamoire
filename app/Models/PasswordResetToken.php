<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    // Menentukan nama tabel
    protected $table = 'password_reset_tokens';

    // Menentukan kolom yang dapat diisi
    protected $fillable = ['email', 'token', 'created_at'];
}
