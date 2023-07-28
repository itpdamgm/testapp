<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPenggunaanTanpaBuktiToCostTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_types', function (Blueprint $table) {
            $table->integer('penggunaan_tanpa_bukti')->default(0)->comment('persentase');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_types', function (Blueprint $table) {
            $table->dropColumn('penggunaan_tanpa_bukti');
        });
    }
}
