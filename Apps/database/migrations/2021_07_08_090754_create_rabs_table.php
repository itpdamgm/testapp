<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rabs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor',50)->unique();
            $table->string('nama');
            $table->foreignId('surat_tugas_detail_id')->constrained('surat_tugas_details');
            $table->foreignId('position_id')->constrained('positions');
            $table->foreignId('type_id')->constrained('types');
            $table->integer('total_rab');
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
        Schema::dropIfExists('rabs');
    }
}
