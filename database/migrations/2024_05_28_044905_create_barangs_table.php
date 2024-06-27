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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('no_barcode');
            $table->string('no_item');
            $table->string('nama_barang');
            $table->string('kode_log');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->integer('harga');
            $table->string('rak');
            $table->integer('total');
            $table->date('tanggal');
            $table->integer('jumlah_minimal');
            $table->string('no_katalog');
            $table->string('merk');
            $table->string('no_akun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
