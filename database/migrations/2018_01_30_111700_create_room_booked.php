<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomBooked extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('room_id');
            $table->timestamp('requested_date');
            $table->timestamp('requested_date_end');
            $table->time('duration');
            $table->integer('authorised_by');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('RoomBooked', function (Blueprint $table) {
            //
        });
    }
}
