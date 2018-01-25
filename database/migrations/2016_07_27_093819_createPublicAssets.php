<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->index();
            $table->string('asset_url', 500);
            $table->string('asset_type', 255)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('public_assets');
    }
}
