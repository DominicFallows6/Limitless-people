<?php

namespace Powhr\Modules\RoomBooking\Controllers;

use Illuminate\Http\Request;
use Powhr\Contracts\PublicAssetsInterface;
use Powhr\Modules\RoomBooking\Repositories\RoomBookingRepository;
use Powhr\Modules\RoomBooking\Module;

class RoomBookingController extends Module
{

    protected $bookingInterface;

    function __construct(
        Request $request,
        PublicAssetsInterface $publicAssets,
        RoomBookingRepository $bookingRepository
    )
    {
        parent::__construct($request, $publicAssets);

        $this->bookingInterface = $bookingRepository;
    }

    public function getIndex()
    {
        $rooms = $this->bookingInterface->Rooms();


        //this may change later for something more efficient
        return \View::make('viewRoom')->with('rooms', $rooms);
    }

    public function getMoreRooms()
    {
        $buildingId = $this->request->input('building_id');
        $rooms = $this->bookingInterface->getMoreRooms($buildingId);

        return \View::make('roomViews')->with('rooms', $rooms);
    }

    public function getRoomInfo()
    {
        $roomNumber = $this->request->input('room_number');
        $roomInfo = $this->bookingInterface->roomInformation($roomNumber);

        $roomInfoAsString = json_encode($roomInfo);
        return $roomInfoAsString;

    }
}
