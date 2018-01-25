<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert(
            array(
                array(
                    'id'=>1,
                    'module_name' => 'Business Announcements',
                    'module_description' => 'Business Announcements',
                    'module_directory' => '/',
                    'module_cost' => 0.00,
                    'active' => 1,
                    'module_base_url' => '/',
                    'module_image' => '/'
                ),
                array(
                    'id'=>2,
                    'module_name' => 'Attendance',
                    'module_description' => 'Attendance',
                    'module_directory' => '/',
                    'module_cost' => 0.00,
                    'active' => 1,
                    'module_base_url' => '/',
                    'module_image' => '/'
                ),
                array(
                    'id'=>3,
                    'module_name' => 'Ideas',
                    'module_description' => 'Ideas',
                    'module_directory' => '/',
                    'module_cost' => 0.00,
                    'active' => 1,
                    'module_base_url' => '/',
                    'module_image' => '/'
                ),
                array(
                    'id'=>4,
                    'module_name' => 'Staff Docs',
                    'module_description' => 'Staff Docs',
                    'module_directory' => '/',
                    'module_cost' => 0.00,
                    'active' => 1,
                    'module_base_url' => '/',
                    'module_image' => '/'
                )
            )
        );

        DB::table('modules_business')->insert(
            [
                [
                    'business_id'=>1,
                    'module_id'=>1
                ],
                [
                    'business_id'=>1,
                    'module_id'=>2
                ],
                [
                    'business_id'=>1,
                    'module_id'=>3
                ],
                [
                    'business_id'=>1,
                    'module_id'=>4
                ]
            ]
        );

    }
}
