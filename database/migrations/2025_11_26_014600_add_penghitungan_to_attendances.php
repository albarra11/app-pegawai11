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
        Schema::table('attendances', function (Blueprint $table) {
            $table->integer('potongan')->default(0);
            $table->integer('lembur_jam')->default(0);
            $table->integer('bonus_lembur')->default(0);
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn(['potongan', 'lembur_jam', 'bonus_lembur']);
        });
    }
};
