<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoomInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('room_building');
            $table->integer('room_name');
            $table->string('room_seats');
            $table->boolean('is_full');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('RoomInformation', function (Blueprint $table) {
            //
        });
    }
}
