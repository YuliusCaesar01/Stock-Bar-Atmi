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
        Schema::create('recaps_barangs', function (Blueprint $table) {
            $table->id();
            $table->date('recap_date'); // The date of the recap
            $table->string('no_item');
            $table->string('nama_barang');
            $table->string('kode_log');
            $table->integer('jumlah');
            $table->integer('harga'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recaps_barangs');
    }
};
