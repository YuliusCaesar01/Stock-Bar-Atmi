<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockSummariesTable extends Migration
{
    public function up()
    {
        Schema::create('stock_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('kd_prod');
            $table->date('date');
            $table->integer('total_stock');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_summaries');
    }
}

