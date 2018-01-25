<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAmPmToHolidays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('holiday_requests', function ($table) {
            $table->string('period', 2)->default('NA');
        });

        Schema::table('holiday_request_groups', function ($table) {
            $table->string('period', 2)->default('NA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('holiday_requests', function ($table) {
            $table->dropColumn('period');
        });

        Schema::table('holiday_request_groups', function ($table) {
            $table->dropColumn('period');
        });

    }
}
