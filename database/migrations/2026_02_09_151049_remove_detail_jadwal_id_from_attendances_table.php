<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDetailJadwalIdFromAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['detail_jadwal_id']);
            // Then drop the column
            $table->dropColumn('detail_jadwal_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Re-add the column if rollback
            $table->unsignedBigInteger('detail_jadwal_id')->nullable()->after('jadwal_id');
            $table->foreign('detail_jadwal_id')->references('id')->on('detail_jadwals')->onDelete('cascade');
        });
    }
}
