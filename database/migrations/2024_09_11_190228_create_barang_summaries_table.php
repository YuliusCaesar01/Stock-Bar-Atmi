<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id'); // Ensure it matches the type of the 'id' field in 'barang' table
            $table->date('summary_date');
            $table->integer('total_entry')->default(0);
            $table->integer('total_exit')->default(0);
            $table->timestamps();
        
            // Foreign key constraint
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->unique(['barang_id', 'summary_date']); // Ensure one summary per day per barang
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_summaries');
    }
}
