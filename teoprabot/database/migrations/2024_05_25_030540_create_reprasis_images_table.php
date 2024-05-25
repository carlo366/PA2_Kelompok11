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
        Schema::create('reprasis_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reprasiid'); // Menyesuaikan kolom reprasiid
            $table->foreign('reprasiid')->references('id')->on('reprasis');
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
        Schema::dropIfExists('reprasis_images');
    }
};
