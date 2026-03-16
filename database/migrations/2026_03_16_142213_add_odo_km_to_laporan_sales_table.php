<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOdoKmToLaporanSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan_sales', function (Blueprint $table) {
            $table->string('odo_km')->nullable()->after('jadwal_id');
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
            $table->dropColumn('odo_km');
        });
    }
}
