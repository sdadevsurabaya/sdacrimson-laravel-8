<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPengirimanToLaporanSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan_sales', function (Blueprint $table) {
            $table->string('pengiriman')->nullable()->after('odo_km');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_sales', function (Blueprint $table) {
            $table->dropColumn('pengiriman');
        });
    }
}
