<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananKasir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'pesanan_kasirs';

    public function kasir(){
        return $this->belongsTo(AkunTenant::class,'id','idKasir');
    }

    public function menu(){
        return $this->hasMany(MenuTenant::class,'id','idMenu');
    }
}
