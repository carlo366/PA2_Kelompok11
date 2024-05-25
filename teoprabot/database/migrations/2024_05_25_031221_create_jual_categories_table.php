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
        Schema::create('jual_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jualid'); // Menyesuaikan kolom product_id
            $table->foreign('jualid')->references('id')->on('juals');
            $table->unsignedBigInteger('category_id'); // Menyesuaikan kolom product_id
            $table->foreign('category_id')->references('id_categories')->on('categories');
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
        Schema::dropIfExists('jual_categories');
    }
};
