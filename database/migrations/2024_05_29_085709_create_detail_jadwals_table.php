<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_jadwals', function (Blueprint $table) {
            $table->id();
            $table->integer('id_header')->unsigned(); // Id_Header
            $table->integer('id_account'); // Id_Account (kode customer/account)
            $table->integer('id_contact'); // Id_Contact (kode contact atau PIC)
            $table->string('activity_type'); // Activity_Type (Call, Meeting, Email, Visit, Demo)
            $table->text('note')->nullable(); // Note
            $table->text('attach')->nullable(); // Attach
            $table->date('date'); // Date (tanggal dilakukan)
            $table->date('plant_date'); // Date (tanggal dilakukan)
            $table->date('actual_date'); // Date (tanggal dilakukan)
            $table->enum('status', ['Done', 'Pending', 'Close']); // Status (Done, Pending, Close)
            $table->timestamp('checkin')->nullable(); // Checkin
            $table->timestamp('checkout')->nullable(); // Checkout
            $table->integer('created_by_id'); // Created by ID
            $table->integer('modified_by_id')->nullable(); // Modified by ID
            $table->boolean('approve')->default(false);
            $table->integer('approve_by_id')->nullable(); // Modified by ID
            $table->timestamps(); // Laravel's created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_jadwals');
    }
}
