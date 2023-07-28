<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRabRealisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rab_realisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rab_id')->constrained();
            $table->string('maskapai',100);
            $table->string('boarding_pass')->nullable();
            $table->string('bahan_bakar')->nullable();
            $table->string('tiket')->nullable();
            $table->string('nama_hotel')->nullable();
            $table->string('invoice')->nullable();
            $table->string('swab')->nullable();
            $table->string('sewa_kendaraan')->nullable();
            $table->string('tambahan')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rab_realisasi');
    }
}
