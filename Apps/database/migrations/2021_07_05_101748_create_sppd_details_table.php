<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSppdDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppd_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sppd_id')->constrained('sppd')->cascadeOnDelete();
            $table->string('tiba_di');
            $table->date('tgl_tiba');
            $table->string('berangkat_dari');
            $table->string('tujuan');
            $table->date('tgl_berangkat');
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
        Schema::dropIfExists('sppd_details');
    }
}
