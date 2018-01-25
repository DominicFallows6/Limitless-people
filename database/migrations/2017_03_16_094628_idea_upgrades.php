<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IdeaUpgrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ideas', function (Blueprint $table){
            $table->string('idea_feedback', 500)->after('description');
        });

        Schema::table('idea_status', function (Blueprint $table){
            $table->string('idea_status_label', 50);
            $table->string('idea_status_hex_color', 10);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
