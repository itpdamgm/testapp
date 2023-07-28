<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSppdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppd', function (Blueprint $table) {
            $table->id();
            $table->string('nomor',50);
            $table->foreignId('surat_tugas_id')->constrained('surat_tugas');
            $table->text('maksud');
            $table->string('alat_angkutan',50);
            $table->date('tgl_berangkat');
            $table->date('tgl_kembali');
            $table->integer('lama_hari');
            $table->string('tempat_berangkat');
            $table->string('tempat_tujuan');
            $table->text('keterangan_lain');
            $table->string('beban_instansi');
            $table->string('beban_kode_akun')->nullable();
            $table->text('catatan')->nullable();
            $table->text('perhatian')->nullable();
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
        Schema::dropIfExists('sppd');
    }
}
