<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiakuiToRabDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rab_details', function (Blueprint $table) {
            $table->boolean('selisih_diakui')->default(true);
            $table->string('ket_diakui')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rab_details', function (Blueprint $table) {
            $table->dropColumn(['selisih_diakui','ket_diakui']);
        });
    }
}
