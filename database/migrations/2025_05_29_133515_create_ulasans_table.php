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
    Schema::create('ulasans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kebaya_id')->constrained('kebayas')->onDelete('cascade');
        $table->string('nama_pengulas');
        $table->tinyInteger('rating')->default(5); // nilai dari 1–5
        $table->text('komentar')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};
