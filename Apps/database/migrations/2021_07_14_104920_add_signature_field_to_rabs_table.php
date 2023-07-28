<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSignatureFieldToRabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rabs', function (Blueprint $table) {
            $table->string('disetujui',50);
            $table->string('diperiksa',50);
            $table->string('pembuat',50);
            $table->string('menyerahkan',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rabs', function (Blueprint $table) {
            $table->dropColumn(['disetujui','diperiksa','pembuat','menyerahkan']);
        });
    }
}
