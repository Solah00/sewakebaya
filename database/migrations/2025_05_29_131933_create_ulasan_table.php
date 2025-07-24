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
    Schema::create('ulasan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('kebaya_id');
        $table->string('nama_pengulas');
        $table->tinyInteger('rating'); // 1 - 5
        $table->text('komentar');
        $table->timestamps();

        $table->foreign('kebaya_id')->references('id')->on('kebayas')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
