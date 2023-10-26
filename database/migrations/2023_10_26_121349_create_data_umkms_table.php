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
        Schema::create('data_umkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            // Nama User
            $table->string('nama_umkm');
            $table->string('alamat');
            $table->string('no_telp_umkm');
            $table->boolean('vip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_umkms');
    }
};
