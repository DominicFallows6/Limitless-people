<?php

use Illuminate\Database\Seeder;

class UserStatusTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_status')->insert([
            'user_status_name' => 'Active',
        ]);

        
    }
}
