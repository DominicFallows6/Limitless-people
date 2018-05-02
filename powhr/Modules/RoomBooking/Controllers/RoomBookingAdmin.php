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
        $buildings = $this->bookingInterface->getArea(0);

        return \View::make('addRoom')->with('Buildings', $buildings);
    }

    public function postAddRoom(Request $request)
    {

        //if your want to get single element,someName in this case
        $room_name = $request->room_name;
        $room_seats = $request->room_seats;
        $room_building = $request->room_building;

        $error = [];
        $buildings = $this->bookingInterface->getArea(0);


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

            return \View::make('addRoom')->with('result', $result)->with('Buildings', $buildings);
        } else {
            return \View::make('addRoom')->with('errors', $error)->with('Buildings', $buildings);
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

    public function getDeleteRoom()
    {
        $rooms = $this->bookingInterface->getAllRooms();

        return \View::make('deleteRoom')->with('rooms', $rooms);
    }

    public function getAddBuilding()
    {
        $buildingNames = $this->bookingInterface->getArea(0);

        return \view::make('addBuilding')->with('buildingNames', $buildingNames);
    }

    public function postDeleteBuilding(Request $request)
    {
        $id = $request->building_id;

        if($results = $this->bookingInterface->deleteBuilding($id) === true){
            $return = true;
            return (json_encode($return));
        } else {
            $return = false;
            return (json_encode($return));
        }
    }

    public function postEditBuilding(Request $request)
    {
        $id = $request->building_id;
        $building_name = $request->building_name;

        $attributes = [
            'id' => $id,
            'building_name' => $building_name
        ];

        if($results = $this->bookingInterface->editBuilding($attributes) === true) {
            $return = true;
            return (json_encode($return));
        } else {
            $return = false;
            return (json_encode($return));
        }
    }

    public function postAddBuilding(Request $request)
    {

        //if your want to get single element,someName in this case
        $building_name = $request->building_name;
        $buildingNames = $this->bookingInterface->getArea(0);

        $error = [];

        if (strlen($building_name) < 1) {
            $error[] = 'Please enter Building name';
        }

        if ($error == null) {

            $attributes = [
                'building_name' => $building_name,
            ];

            $result = $this->bookingInterface->addArea($attributes);
            $buildingNames = $this->bookingInterface->getArea(0);

            return \view::make('addBuilding')->with('result', $result)->with('buildingNames', $buildingNames);
        } else {
            return \view::make('addBuilding')->with('errors', $error)->with('buildingNames', $buildingNames);
        }

    }
}