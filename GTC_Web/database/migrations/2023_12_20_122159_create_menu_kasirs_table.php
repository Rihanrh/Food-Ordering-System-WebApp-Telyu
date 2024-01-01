<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_kasirs', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nama_produk');
            $table->integer('harga_produk');
            $table->foreignId('idKasir')->constrained('akun_kasirs','id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_kasirs');
    }
};
