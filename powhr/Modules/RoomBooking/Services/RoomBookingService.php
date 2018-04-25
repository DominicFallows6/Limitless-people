<?php
/**
 * Created by PhpStorm.
 * User: dfallows
 * Date: 08/03/2018
 * Time: 11:07
 */

namespace Powhr\Modules\RoomBooking\Services;

use Powhr\Modules\RoomBooking\Repositories\RoomBookingRepository;
use Powhr\Modules\RoomBooking\TableBuilderclasses\DailyRoomBooking;
use Powhr\Modules\RoomBooking\TableBuilderclasses\WeeklyRoomBooking;
use Powhr\Modules\RoomBooking\TableBuilderclasses\MonthlyRoomBooking;

class RoomBookingService
{

    public $dailyRoomBooking;
    public $weeklyRoomBooking;
    public $monthlyRoomBooking;
    public $dataFromGet;

    protected $roomBookingRepository;
    protected $RoomBookingController;
    protected $roomData;
    protected $roomNames;
    protected $times;

    function __construct(RoomBookingRepository $roomBookingRepository, DailyRoomBooking $dailyRoomBooking, WeeklyRoomBooking $weeklyRoomBooking, MonthlyRoomBooking $monthlyRoomBooking)
    {
        $this->roomBookingRepository = $roomBookingRepository;
        $this->dailyRoomBooking = $dailyRoomBooking;
        $this->weeklyRoomBooking = $weeklyRoomBooking;
        $this->monthlyRoomBooking = $monthlyRoomBooking;
    }

    function getDataForRoom($dataFromGet)
    {
        $this->dataFromGet = $dataFromGet;
        $this->roomNames = $this->roomBookingRepository->roomInformationNames($dataFromGet);
        $this->roomData = $this->roomBookingRepository->BookingInformation($dataFromGet);
        $this->times = $this->roomBookingRepository->roomBookingTimes();

        return $this->setToAbstractClass();
    }


    function setToAbstractClass()
    {
        return $this->choiceRender();
    }

    public function choiceRender(): string
    {
        $decideDayWeekMonth = $this->dataFromGet;
        if ($decideDayWeekMonth['checkMonthDayWeek'] == 'month') {

            $this->monthlyRoomBooking->setTableData($this->roomData);
            $this->monthlyRoomBooking->setTimeData($this->times);
            $this->monthlyRoomBooking->setRoomNames($this->roomNames);

            return $this->monthlyRoomBooking->render();
        } else if ($decideDayWeekMonth['checkMonthDayWeek'] == 'week') {

            $this->weeklyRoomBooking->setTableData($this->roomData);
            $this->weeklyRoomBooking->setTimeData($this->times);
            $this->weeklyRoomBooking->setRoomNames($this->roomNames);

            return $this->weeklyRoomBooking->render();
        } else if ($decideDayWeekMonth['checkMonthDayWeek'] == 'day') {

            $this->dailyRoomBooking->setTableData($this->roomData);
            $this->dailyRoomBooking->setTimeData($this->times);
            $this->dailyRoomBooking->setRoomNames($this->roomNames);

            return $this->dailyRoomBooking->render();
        } else {
            return '';
        }
    }

}