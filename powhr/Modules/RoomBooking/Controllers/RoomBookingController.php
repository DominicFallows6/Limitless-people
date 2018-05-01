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

        if ($this->request->get('view-month')) {
            $dayWeekMonth = $this->request->get('view-month');
            $decideMonthDayWeek = 'month';
        } else if ($this->request->get('view-week')) {
            $dayWeekMonth = $this->request->get('view-week');
            $decideMonthDayWeek = 'week';
        } else if ($this->request->get('view-day')) {
            $dayWeekMonth = $this->request->get('view-day');
            $decideMonthDayWeek = 'day';
        } else {
            $dayWeekMonth = '';
        }

        $building = $this->request->get('area');

        $dataFromGet = ['buildingId' => $building, 'MonthWeekDay' => $dayWeekMonth, 'checkMonthDayWeek' => $decideMonthDayWeek];

        $tableData = $this->RoomBookingService->getDataForRoom($dataFromGet);

        $buildings = $this->bookingInterface->getArea(1);

        $building = null;
        $dataFromGet = null;
        $dayWeekMonth = null;
        $decideMonthDayWeek = null;

        return \View::make('viewRoom')->with('Data', $tableData)->with('Buildings', $buildings);
    }

}