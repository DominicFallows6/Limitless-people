<?php
/**
 * Created by PhpStorm.
 * User: dfallows
 * Date: 08/03/2018
 * Time: 11:12
 */

namespace Powhr\Modules\RoomBooking;


abstract class RoomBookingAbstractClass
{
    protected $tableData;

    /**
     * supply A data array with element key
     * @param array $dataArray
     * @return void
     */
    public function setTableData(array $dataArray = [])
    {
        $this->tableData = $dataArray;
    }

    abstract public function render() : string;
}