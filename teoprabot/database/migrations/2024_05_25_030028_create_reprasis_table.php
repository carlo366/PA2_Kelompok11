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
        Schema::create('reprasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nameproduct');
            $table->string('nama',255);
            $table->string('kondisi');
            $table->string('kategory');
            $table->text('deskripsi');
            $table->text('phonenumber');
            $table->text('zip');
            $table->text('provinsi');
            $table->text('Kabupaten');
            $table->text('kecamatan');
            $table->text('desa');
            $table->text('alamat');
            $table->text('price')->nullable();
            $table->text('request');
            $table->enum('status', ['tolak', 'terima'])->nullable();
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
        Schema::dropIfExists('reprasis');
    }
};
