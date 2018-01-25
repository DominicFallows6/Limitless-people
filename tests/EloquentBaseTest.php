<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EloquentBaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        
        $holidayRequestGroup = new \Powhr\Modules\HolidayRequests\Repositories\HolidayRequestGroups();
        $item = $holidayRequestGroup->getItem(1);
        
        $business = new \Powhr\Models\Business();
        $unit = $business->getItem(1);

        //var_dump($item);
        
        $this->assertTrue(true);
    }
}
