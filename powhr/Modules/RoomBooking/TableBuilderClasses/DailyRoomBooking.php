<?php
/**
 * Created by PhpStorm.
 * User: dfallows
 * Date: 08/03/2018
 * Time: 11:21
 */

namespace Powhr\Modules\RoomBooking\TableBuilderClasses;

use Powhr\Modules\RoomBooking\AbstractClasses\RoomBookingAbstractClass;

class DailyRoomBooking extends RoomBookingAbstractClass
{
    public function render(): string
    {
        $data = $this->tableData;
        $times = $this->tableTimes;
        $rooms = $this->roomNames;

        $tableStart = "<table class='table_main'><thead><tr id='table_first' class='first_last'><th class='first_last'>Time:</th>";

        foreach ($data as $result) {
            $tableId = $result['id'];
            foreach ($rooms as $room) {
                $tableStart .= "<th data-room='$tableId'> <a>{$room['room_name']}</a> </th>";
            }
        }

        $tableMid = "</tr></thead><tbody>";

        $a = 0;
        foreach ($times as $time) {
            if ($a % 2 == 0) {
                $tableMid .= "<tr class='even_row'><td class='time'>{$time['times']}</td>";
                foreach ($rooms as $room) {
                    $tableMid .= "<td class='new'><div class='celldiv slots1'></div></td>";
                }
                $tableMid .= "</tr>";
            } else {
                $tableMid .= "<tr class='odd_row'><td class='time'>{$time['times']}</td>";
                foreach ($rooms as $room) {
                    $tableMid .= "<td class='new'><div class='celldiv slots1'></div></td>";
                }
            }
            $a++;
        }

        $tableStart .= $tableMid;
        $tableEnd = "</tbody></table>";
        $tableStart .= $tableEnd;
        return $tableStart;
    }
}