<?php
/**
 * Created by PhpStorm.
 * User: dfallows
 * Date: 08/03/2018
 * Time: 11:12
 */

namespace Powhr\Modules\RoomBooking\AbstractClasses;


abstract class RoomBookingAbstractClass
{
    protected $tableData = null;
    protected $tableTimes = null;
    protected $roomNames = null;

    /**
     * supply A data array with element key
     * @param array $roomArray
     * @return void
     */
    public function setRoomNames(array $roomArray = [])
    {
        $this->roomNames = $roomArray;
    }

    /**
     * supply A data array with element key
     * @param array $dataArray
     * @return void
     */
    public function setTableData(array $dataArray = [])
    {
        $this->tableData = $dataArray;
    }

    /**
     * @param array $timeArray
     * @return void
     */
    public function setTimeData(array $timeArray = [])
    {
        $this->tableTimes = $timeArray;
    }

    abstract public function render() : string;
}