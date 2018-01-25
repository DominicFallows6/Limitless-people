<?php

use Illuminate\Database\Seeder;

class add_business_asset_name_for_ts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business')
            ->where('id', 1)
            ->update(['business_asset_name' => 'trueshopping']);
    }
}
