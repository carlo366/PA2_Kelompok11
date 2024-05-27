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
        Schema::create('juals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nameproduct');
            $table->string('kategory');
            $table->string('nama',255);
            $table->text('phonenumber');
            $table->string('kondisi');
            $table->text('deskripsi');
            $table->text('zip');
            $table->text('provinsi');
            $table->text('Kabupaten');
            $table->text('kecamatan');
            $table->text('desa');
            $table->text('alamat');
            $table->text('price')->nullable();
            $table->string('hargadasar');
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
        Schema::dropIfExists('juals');
    }
};
