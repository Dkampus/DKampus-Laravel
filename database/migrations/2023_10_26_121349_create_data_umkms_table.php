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
            $table->string('nama_umkm');
            $table->string('logo_umkm');
            $table->string('alamat');
            $table->string('no_telp_umkm');
            $table->enum('vip', ['0', '1']);
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
