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
        Schema::create('pesanan_kasirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idKasir')->constrained('akun_kasirs','id')->onDelete('cascade');
            $table->foreignId('idMenu')->constrained('menu_kasirs','id')->onDelete('cascade');
            $table->bigInteger('idPesananKasir');
            $table->integer('quantity');
            $table->integer('totalHarga');
            $table->string('metodePembayaran');
            $table->string('statusPesanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_kasirs');
    }
};
