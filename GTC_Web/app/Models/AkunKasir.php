<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;


class AkunKasir extends Model
{
    use HasFactory;

    protected $table = 'akun_kasirs';

    protected $fillable = [
        'nama_kasir', 'username_kasir', 'password_kasir',
    ];
}
