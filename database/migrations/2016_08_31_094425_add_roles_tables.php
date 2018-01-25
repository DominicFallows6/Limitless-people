<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module_name');
            $table->string('module_description');
            $table->decimal('module_cost', 10, 2)->default(0.00);
            $table->string('module_directory');
            $table->string('module_base_url');
            $table->string('module_image');
            $table->tinyInteger('active')->unsigned();
        });

        Schema::create('modules_business', function (Blueprint $table) {
            $table->integer('business_id')->index();
            $table->integer('module_id')->index();
        });

        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name');
            $table->string('role_description');
            $table->integer('module_id');
        });

        Schema::create('users_user_roles', function (Blueprint $table) {
            $table->integer('user_id')->index();
            $table->integer('user_role_id')->index();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('modules');
        Schema::drop('modules_business');
        Schema::drop('user_roles');
        Schema::drop('users_user_roles');

    }
}
