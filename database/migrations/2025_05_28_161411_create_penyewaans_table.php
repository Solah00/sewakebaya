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
    Schema::create('penyewaan', function (Blueprint $table) {
        $table->id();
        $table->string('kode_sewa')->unique();
        $table->unsignedBigInteger('pelanggan_id'); // relasi pelanggan
        $table->date('tanggal_sewa');
        $table->decimal('total_bayar', 15, 2);
        $table->timestamps();

        $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};
