<?php

namespace Powhr\Modules\RoomBooking\Controllers;

use Illuminate\Http\Request;
use Powhr\Contracts\PublicAssetsInterface;
use Powhr\Modules\RoomBooking\Repositories\RoomBookingRepository;

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
        return \View::make('EditRoomBookingAdmin');
    }

    public function getAddRoom()
    {
        return \View::make('addRoom');
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

    public function getDeleteRoom()
    {
        $rooms = $this->bookingInterface->getAllRooms();

        return \View::make('deleteRoom')->with('rooms', $rooms);
    }

    public function getAddBuilding()
    {
        return \view::make('addBuilding');
    }

    public function postAddBuilding(Request $request)
    {

        //if your want to get single element,someName in this case
        $building_name = $request->building_name;

        $error = [];


        if (strlen($building_name) < 1) {
            $error[] = 'Please enter room name';
        }

        if ($error == null) {

            $attributes = [
                'building_name' => $building_name,
            ];

            $result = $this->bookingInterface->addArea($attributes);

            return \view::make('addBuilding')->with('result', $result);
        } else {
            return \view::make('addBuilding')->with('errors', $error);
        }

    }

}