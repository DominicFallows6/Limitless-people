<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDifferentTypesOfLeave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday_request_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('holiday_request_type_name');
            $table->tinyInteger('counts_as_leave')->unsigned();
            $table->tinyInteger('needs_approval')->unsigned();
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
        Schema::drop('holiday_request_types');
    }
}
