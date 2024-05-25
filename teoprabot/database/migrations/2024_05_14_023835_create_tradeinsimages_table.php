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
        Schema::create('tradeinsimages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trendinsid'); // Menyesuaikan kolom trendinsid
            $table->foreign('trendinsid')->references('id')->on('tradeins');
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
        Schema::dropIfExists('tradeinsimages');
    }
};
