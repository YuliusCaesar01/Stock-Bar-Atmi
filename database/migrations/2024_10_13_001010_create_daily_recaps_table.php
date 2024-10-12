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
        Schema::create('daily_recaps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('added')->default(0);
            $table->integer('subtracted')->default(0);
            $table->date('recap_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_recaps');
    }
};
