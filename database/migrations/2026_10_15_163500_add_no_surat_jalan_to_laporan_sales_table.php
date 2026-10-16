<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoSuratJalanToLaporanSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan_sales', function (Blueprint $table) {
            $table->string('no_surat_jalan')->nullable()->after('pengiriman');
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
            $table->dropColumn('no_surat_jalan');
        });
    }
}
