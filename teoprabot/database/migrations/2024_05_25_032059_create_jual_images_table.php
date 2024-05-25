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
        Schema::create('jual_images', function (Blueprint $table) {
            $table->id();
              $table->unsignedBigInteger('jualid'); // Menyesuaikan kolom jualid
            $table->foreign('jualid')->references('id')->on('juals');
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
        Schema::dropIfExists('jual_images');
    }
};
