<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class MenuKasir extends Model
{
    use HasFactory;
    protected $fillable = ["foto","nama_produk","harga_produk"];
    protected $table = 'menu_kasirs';

    public function kasir(){
        return $this->belongsTo(AkunKasir::class,'id','idKasir');
    }
}
