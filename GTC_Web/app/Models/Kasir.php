<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kasir extends Model
{
    use HasFactory;

    protected $table = 'kasirs';

    protected $fillable = [
        'nama_kasir', 'username_kasir', 'password_kasir',
    ];
}
