<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->tinyInteger('user_status_id')->unsigned()->default('1');
        });

        Schema::create('user_status', function (Blueprint $table)  {
            $table->increments('id');
            $table->string('user_status_name', '25');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('user_status_id');
        });

        Schema::drop('users');

    }



}
