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
    Schema::create('kebayas', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->integer('harga_sewa');
        $table->string('foto')->nullable(); // jika sudah menambahkan upload foto
        $table->timestamps();
    });
}
 
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebayas');
    }
};
