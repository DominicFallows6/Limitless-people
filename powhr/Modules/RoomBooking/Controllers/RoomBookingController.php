<?php

namespace Powhr\Modules\RoomBooking\Controllers;

use Illuminate\Http\Request;
use Powhr\Contracts\PublicAssetsInterface;
use Powhr\Modules\RoomBooking\Repositories\RoomBookingRepository;
use Powhr\Modules\RoomBooking\Module;
use Powhr\Modules\RoomBooking\Services\RoomBookingService;

class RoomBookingController extends Module
{

    protected $bookingInterface;
    protected $bookingInterfaceMonth;
    protected $RoomBookingService;

    function __construct(
        Request $request,
        PublicAssetsInterface $publicAssets,
        RoomBookingRepository $bookingRepository,
        RoomBookingService $RoomBookingService
    )
    {
        parent::__construct($request, $publicAssets);

        $this->bookingInterface = $bookingRepository;
        $this->RoomBookingService = $RoomBookingService;
    }

    public function getIndex()
    {
        return \View::make('viewRoom');
    }

    public function getCreateRoomBookingTable()
    {
        $decideMonthDayWeek = '';
        $room = null;

        if ($this->request->get('viewMonth')) {
            $dayWeekMonth = $this->request->get('viewMonth');
            $decideMonthDayWeek = 'month';
        } else if ($this->request->get('viewWeek')) {
            $dayWeekMonth = $this->request->get('viewWeek');
            $decideMonthDayWeek = 'week';
        } else if ($this->request->get('viewDay')) {
            $dayWeekMonth = $this->request->get('viewDay');
            $decideMonthDayWeek = 'day';
        } else {
            $dayWeekMonth = '';
        }

        if(isset($_GET['room'])){
            $room = $_GET['room'];
        }

        $area = $_GET['area'];

        $building = $this->request->get('area');

        $dataFromGet = ['buildingId' => $building, 'MonthWeekDay' => $dayWeekMonth, 'checkMonthDayWeek' => $decideMonthDayWeek, 'roomId' => $room];

        $tableData = $this->RoomBookingService->getDataForRoom($dataFromGet);

        $buildings = $this->bookingInterface->getArea(1);

        $rooms = $this->bookingInterface->getRooms(1, $area);

        $building = null;
        $dataFromGet = null;
        $dayWeekMonth = null;
        $decideMonthDayWeek = null;

        return \View::make('viewRoom')->with('Data', $tableData)->with('Buildings', $buildings)->with('rooms', $rooms);
    }

    public function postAddBooking(Request $request)
    {

        $date = date('y.m.d');
        $roomInfoId = $this->bookingInterface->getBookingRoomId($request->room_Name, $request->area_Id);

        $attributes = [
            'requested_time' => $request->start_Time,
            'requested_time_end' => $request->end_Time,
            'room_information_id' => $roomInfoId[0]['id'],
            'user_id' => $this->userID,
            'requested_date' => $date,
            'requested_date_end' => $date
        ];

        return $this->bookingInterface->addBooking($attributes);

    }

}