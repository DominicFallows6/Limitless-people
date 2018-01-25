<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStaffDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('business_id')->index();
            $table->integer('user_id');
            $table->tinyInteger('visibility');
            $table->string('asset_name', 255);
            $table->string('original_name', 255);
            $table->string('asset_url', 500);
            $table->string('description', 500);
            $table->string('asset_size', 30);
            $table->string('type');
            $table->string('extension');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('staff_docs');
    }
}
