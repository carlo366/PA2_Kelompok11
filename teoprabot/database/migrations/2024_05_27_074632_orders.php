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
            $table->unsignedBigInteger('tradeinsid')->nullable(); // Menyesuaikan nama kolom
            // $table->foreign('tradeinsid')->references('id')->on('tradeins'); // Menggunakan tipe data yang sama
            $table->text('product_img');
            $table->string('nama', 255);
            $table->text('phonenumber');
            $table->text('zip');
            $table->text('provinsi');
            $table->text('Kabupaten');
            $table->text('kecamatan');
            $table->text('alamat');
            $table->text('request');
            $table->text('desa');
            $table->text('quantity');
            $table->text('ongkir')->nullable();
            $table->text('price');
            $table->text('totalprice');
            $table->dateTime('tanggalantar')->nullable(); // Menggunakan dateTime
            $table->enum('metode', ['cod', 'payment'])->nullable();
            $table->enum('statuspembayaran', ['Unpaid', 'Paid'])->nullable();
            $table->enum('status', ['proses', 'packaging', 'sedangperjalan', 'selesai','terima','tolak'])->default('proses');
            $table->text('komentar')->nullable();
            $table->text('img_bayar')->nullable();
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
        //
    }
};
