<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *ye
     * @return void
     */
    public function up()
    {
        Schema::create('tradeins', function (Blueprint $table) {
            $table->bigIncrements('id'); // Menggunakan bigIncrements yang sesuai dengan unsignedBigInteger
            $table->json('name');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('kondisi');
            $table->text('deskripsi');
            $table->string('price')->nullable();
            $table->string('hargadasar')->nullable();
            $table->enum('status', ['tolak', 'terima','selesai'])->nullable();
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
        Schema::dropIfExists('tradeins');
    }
};
