<?php
/**
 * Created by PhpStorm.
 * User: dfallows
 * Date: 08/03/2018
 * Time: 11:18
 */

namespace Powhr\Modules\RoomBooking\TableBuilderClasses;

use Powhr\Modules\RoomBooking\AbstractClasses\RoomBookingAbstractClass;

class MonthlyRoomBooking extends RoomBookingAbstractClass
{

    public function render(): string
    {

        $data = $this->tableData;
        $times = $this->tableTimes;
        $rooms = $this->roomNames;
        $startTime = $times[0]['start_time'];
        $endTime = $times[0]['end_time'];
        $times = $this->setTimeArray($startTime, $endTime);
        $newBookings = $this->setDataArray($data, $rooms);


        $tableStart = "<table class='table_main'><thead><tr id='table_first' class='first_last'><th class='first_last'>Room:</th>";
        $tableMid = "</tr></thead><tbody>";
        $tableEnd = "</tbody></table>";

        foreach ($times as $key => $time) {
            $tableStart .= "<th class='first_last'>{$time}</th>";
        }

        foreach ($newBookings as $booking) {
            $tableMid .= "<tr class='even_row'><td class='room_Name' id='room_Name'>{$booking['Room']}</td>";
            $a = 0;
            $e = 0;
            $i = 0;

            foreach ($times as $time) {

                if ($a == count($booking['Bookings'])) {
                    $a = 0;
                }
                if ($e == count($booking['Bookings'])) {
                    $e = 0;
                }

                if (count($booking['Bookings']) < 1) {
                    $tableMid .= "<td class='new' id='no_Bookings'></td>";
                    $i++;
                } else if ($booking['Bookings'][$a]['start_Time'] == $time) {
                    $tableMid .= "<td class='room_Booked' id='{$booking['Bookings'][$a]['start_Time']}'>{$booking['Bookings'][$a]['user_Id']}</td>";
                    $a++;
                } else if ($booking['Bookings'][$e]['end_Time'] == $time) {
                    $tableMid .= "<td class='room_Booked' id='{$booking['Bookings'][$e]['start_Time']}'>{$booking['Bookings'][$e]['user_Id']}</td>";
                    $e++;
                } else {
                    $tableMid .= "<td class='new' id='no_Bookings'></td>";
                    $i++;
                }

            }

        }

        $tableStart .= $tableMid;
        $tableStart .= $tableEnd;
        return $tableStart;
    }

    public function setTimeArray($startTime, $endTime)
    {
        $i = 0;
        $endTimes = strtotime($endTime);
        $endTime = date("H:i", strtotime('+30 minutes', $endTimes));
        do {
            $times[$i] = $startTime;
            $time = strtotime($startTime);
            $startTime = date("H:i", strtotime('+30 minutes', $time));
            $i++;
        } while ($startTime != $endTime);

        return ($times);
    }

    public function setDataArray($data, $rooms)
    {
        $newBookings = [];

        $x = 0;
        foreach ($rooms as $key) {
            $newBookings[$x] = array(
                'Room' => $key['room_name'], 'Bookings' => []
            );
            $y = 0;
            foreach ($data as $value) {
                if ($value['room_name'] == $newBookings[$x]['Room']) {
                    $newBookings[$x]['Bookings'][$y] = [
                        'room_Name' => $value['room_name'],
                        'start_Time' => $value['requested_time'],
                        'end_Time' => $value['requested_time_end'],
                        'user_Id' => $value['user_id']
                    ];
                    $y++;
                }
            }
            $x++;
        }
        return ($newBookings);

    }
}