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
        $table->unsignedBigInteger('kebaya_id')->nullable()->change();
    });
}

public function down()
{
    Schema::table('penyewaan', function (Blueprint $table) {
        $table->unsignedBigInteger('kebaya_id')->nullable(false)->change();
    });
}

};
