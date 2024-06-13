<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_customer',
        'no_hp_customer',
        'email_customer',
        'password_customer',
    ];
}
