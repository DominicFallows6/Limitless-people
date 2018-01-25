<?php

use Illuminate\Database\Seeder;

class add_leave_types extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('holiday_request_types')->insert(
            [
                [
                    'holiday_request_type_name'=>'Holiday Request',
                    'counts_as_leave' => '1',
                    'needs_approval' => 1,
                ],
                [
                    'holiday_request_type_name'=>'Sickness Absence',
                    'counts_as_leave' => '1',
                    'needs_approval' => 1,
                ],
                [
                    'holiday_request_type_name'=>'Working From Home',
                    'counts_as_leave' => '0',
                    'needs_approval' => 0,
                ],
                [
                    'holiday_request_type_name'=>'Work based Visit',
                    'counts_as_leave' => '0',
                    'needs_approval' => 0,
                ],
                [
                    'holiday_request_type_name'=>'Flexi day',
                    'counts_as_leave' => '0',
                    'needs_approval' => 1,
                ],
                [
                    'holiday_request_type_name'=>'Compassionate Leave',
                    'counts_as_leave' => '0',
                    'needs_approval' => 1,
                ],
                [
                    'holiday_request_type_name'=>'Unpaid Leave',
                    'counts_as_leave' => '0',
                    'needs_approval' => 1,
                ],
                [
                    'holiday_request_type_name'=>'Lieu Day',
                    'counts_as_leave' => '0',
                    'needs_approval' => 1,
                ]
            ]
        );
    }
}
