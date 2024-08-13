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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('variations_produk')->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('warna');
            $table->string('ukuran');
            $table->integer('kuantitas');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total_harga', 15, 2);
            $table->string('image');
            $table->string('nama_pemilik_rumah')->nullable();
            $table->string('alamat_lengkap')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('link_lokasi')->nullable();
            $table->string('metode_pembayaran')->default('COD');
            $table->string('no_rekening')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status')->default('pending');
            $table->string('status_pembayaran')->default('belum dibayar');
            $table->string('order_id')->nullable();
            $table->string('snap_token')->nullable();
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
        Schema::dropIfExists('pesanan');
    }
};
