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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id_orders');
            $table->string('kodeorder')->unique();
            $table->text('product_id');
            $table->text('product_nama');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('product_img');
            $table->string('nama',255);
            $table->text('phonenumber');
            $table->text('zip');
            $table->text('provinsi');
            $table->text('Kabupaten');
            $table->text('kecamatan');
            $table->text('alamat');
            $table->text('request');
            $table->text('desa');
            $table->text('quantity');
            $table->text('price');
            $table->text('totalprice');
            $table->enum('metode',['cod','payment'])->nullable();
            $table->enum('statuspembayaran',['Unpaid','Paid'])->default('Unpaid');
            $table->enum('status',['proses','packaging','sedangperjalan','selesai'])->default('proses');
            $table->text('komentar')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
