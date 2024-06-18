<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_konveksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konveksi_id')->constrained('konveksi')->onDelete('cascade');
            $table->integer('variasi_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('warna');
            $table->string('ukuran');
            $table->integer('kuantitas');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total_harga', 15, 2);
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_konveksi');
    }
};
