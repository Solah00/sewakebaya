<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('penyewaan_detail', function (Blueprint $table) {
        $table->id();
        $table->foreignId('penyewaan_id')->constrained('penyewaan')->onDelete('cascade');
        $table->foreignId('kebaya_id')->constrained('kebayas')->onDelete('cascade');
        $table->integer('qty')->default(1);
        $table->integer('harga'); // harga sewa per item pada saat transaksi
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('penyewaan_detail');
}

};
