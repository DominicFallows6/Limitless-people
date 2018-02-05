<?php

namespace Powhr\Modules\RoomBooking\Controllers;

use Illuminate\Http\Request;
use Powhr\Contracts\PublicAssetsInterface;
use Powhr\Modules\RoomBooking\Repositories\RoomBookingRepository;
use Powhr\Modules\RoomBooking\Module;

class RoomBookingAdmin extends \Powhr\Modules\RoomBooking\Module
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
        $rooms = ['1', '2', '3', '4', '5'];

        //this may change later for something more efficient
        return \View::make('EditRoomBookingAdmin')->with('rooms', $rooms);
    }

    public function getUser()
    {
        $userID = $this->userID;

        return \View::make('userTest')->with('userID', $userID);

    }

    public function getRoomInfo()
    {
        $roomNumber = $this->request->input('room_number');
        $roomInfo = $this->bookingInterface->roomInformation($roomNumber);

        $roomInfoAsString = json_encode($roomInfo);
        return $roomInfoAsString;
    }

    public function postAddRoom(Request $request)
    {

        //if your want to get single element,someName in this case
        $room_name = $request->room_name;
        $room_seats = $request->room_seats;
        $room_building = $request->room_building;

        $error = [];


        if (strlen($room_name) < 1) {
            $error[] = 'Please enter room name';
        }

        if (strlen($room_seats) < 1) {
            $error[] = 'You must enter at least one seat';
        } elseif (is_numeric($room_seats) === false) {
            $error[] = 'Please enter a valid number in room seats';
        }

        if ($error == null) {

            $attributes = [
                'room_name' => $room_name,
                'room_seats' => $room_seats,
                'building_id' => $room_building
            ];

            $result = $this->bookingInterface->addRoom($attributes);

            return \View::make('addRoom')->with('result', $result);
        } else {
            return \View::make('addRoom')->with('errors', $error);
        }

    }

    public function postDeleteRoom(Request $request)
    {
        $id = $request->room_id;
        if ($this->bookingInterface->deleteRoom($id) === true) {
            $return = true;
            return (json_encode($return));
        } else {
            $return = false;
            return (json_encode($return));
        }
    }

    public function postEditRoom(Request $request)
    {
        $id = $request->room_id;
        $room_name = $request->room_name;
        $room_seats = $request->room_seats;
        $room_building = $request->room_building;

        $attributes = [
            'id' => $id,
            'room_name' => $room_name,
            'room_seats' => $room_seats,
            'building_id' => $room_building
        ];
        $this->bookingInterface->editRoom($attributes);

    }

    public function getAddRoom()
    {
        return \View::make('addRoom');
    }

    public function getDeleteRoom()
    {
        $rooms = $this->bookingInterface->getAllRooms();

        return \View::make('deleteRoom')->with('rooms', $rooms);
    }

    public function getAddBuilding()
    {
        return \View::make('addBuilding');
    }

}