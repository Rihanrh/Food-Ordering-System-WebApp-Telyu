<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('akun_kasirs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kasir');
            $table->string('username_kasir');
            $table->string('password_kasir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_kasirs');
    }
};
