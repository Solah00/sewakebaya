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
    Schema::table('penyewaan', function (Blueprint $table) {
        $table->foreign('kebaya_id')->references('id')->on('kebayas')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('penyewaan', function (Blueprint $table) {
        $table->dropForeign(['kebaya_id']);
    });
}

};
