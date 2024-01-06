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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_umkm_id');
            $table->string('nama_makanan');
            $table->string('slug');
            // Nama UMKM
            $table->text('deskripsi');
            $table->string('image');
            $table->integer('harga');
            $table->int("promo");
            $table->string('kategori');
            $table->decimal('rating');            
            $table->timestamps();

            $table->foreign('data_umkm_id')->references('id')->on('data_umkms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
