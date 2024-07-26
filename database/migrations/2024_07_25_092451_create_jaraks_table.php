<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJaraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jaraks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('general_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('jadwal_id')->nullable();
            $table->string('latitude1')->nullable();
            $table->string('longitude1')->nullable();
            $table->string('latitude2')->nullable();
            $table->string('longitude2')->nullable();
            $table->string('distance')->nullable();
            $table->string('duration')->nullable();

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
        Schema::dropIfExists('jaraks');
    }
}
