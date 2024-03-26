<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AkunKasir extends Authenticatable
{
    use HasFactory;

    protected $table = 'akun_kasirs';

    protected $fillable = [
        'nama_kasir', 'username_kasir', 'password_kasir',
    ];

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password_kasir;
    }
}
