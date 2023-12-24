<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        "fotoProduk",
        "namaProduk",
        "HargaProduk"
    ];
    
    public function tenant(){
        return $this->belongsTo(Tenant::class,'id','idTenant');
    }

}
