<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoTiketToRabRealisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rab_realisasi', function (Blueprint $table) {
            $table->string('no_boarding_pass',50)->nullable();
            $table->string('no_tiket',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rab_realisasi', function (Blueprint $table) {
            $table->dropColumn(['no_tiket','no_boarding_pass']);
        });
    }
}
