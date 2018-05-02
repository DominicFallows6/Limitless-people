<?php
/**
 * Created by PhpStorm.
 * User: dfallows
 * Date: 30/01/2018
 * Time: 14:30
 */

namespace Powhr\Modules\RoomBooking\Repositories;

use Powhr\Models\User;
use Powhr\Models\RoomBookingModel;
use Powhr\Models\BuildingModel;
use Powhr\Models\RoomBookingBookingsModel;
use Powhr\Models\Business;
use Powhr\Models\PowhrEloquentModel;
use Powhr\Modules\RoomBooking\Interfaces\RoomBookingInterface;

class RoomBookingRepository extends PowhrEloquentModel implements RoomBookingInterface
{

    protected $userModel;
    protected $RoomBookingModel;
    protected $roomBookingBookingsModel;
    protected $businessModel;
    protected $BuildingModel;

    public function __construct(array $attributes = [], User $userModel,BuildingModel $BuildingModel, RoomBookingModel $RoomBookingModel, Business $businessModel, RoomBookingBookingsModel $roomBookingBookingsModel)
    {
        parent::__construct($attributes);
        $this->BuildingModel = $BuildingModel;
        $this->userModel = $userModel;
        $this->RoomBookingModel = $RoomBookingModel;
        $this->businessModel = $businessModel;
        $this->roomBookingBookingsModel = $roomBookingBookingsModel;
    }

    function roomInformationNames(array $data)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = $this->RoomBookingModel->select('room_name');
        $query->where('building_id', '=', $data['buildingId']);
        $results = $query->get()->toArray();
        return $results;
    }

    function BookingInformation(array $data)
    {
        /** @var \Illuminate\Database\Query\Builder $query */

        $query = $this->roomBookingBookingsModel->select([
            'room_bookings.requested_time',
            'room_bookings.requested_time_end',
            'room_bookings.user_id',
            'room_information.room_name',
            'room_information.id'
        ]);
        $query->leftJoin('room_information', 'room_bookings.room_information_id', '=', 'room_information.id');
        $query->where('room_information.building_id', '=', $data['buildingId']);
        $results = $query->get()->toArray();

        foreach ($results as $key => $result){
            $query = $this->userModel->select('first_name', 'surname');
            $query->where('id', '=', $result['user_id']);
            $users = $query->get()->toArray();
            $userName = $users[0]['first_name'] . ' ' . $users[0]['surname'];
            $results[$key]['user_id'] = $userName;
        }

        return $results;

    }

    function roomBookingTimes()
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $times = $this->businessModel->select('start_time', 'end_time');
        $results = $times->get()->toArray();

        return $results;
    }

    public function addRoom(array $attributes)
    {
        $this->RoomBookingModel->room_name = $attributes['room_name'];
        $this->RoomBookingModel->room_seats = $attributes['room_seats'];
        $this->RoomBookingModel->building_id = $attributes['building_id'];

        if ($this->RoomBookingModel->save()) {
            return (true);
        } else {
            return (false);
        }
    }

    public function getAllRooms()
    {
        /** @var \Illuminate\Database\Query\Builder $query */

        $query = $this->RoomBookingModel->select(['*']);
        $results = $query->get();

        return $results;
    }

    function addArea(array $attributes){
        $this->BuildingModel->building_name = $attributes['building_name'];

        if($this->BuildingModel->save()){
            return(true);
        } else {
            return(false);
        }
    }

    function getArea($selectOrAll)
    {
        $query = $this->BuildingModel->select('*');
        $results = $query->get()->toArray();
        $buildings = '';

        if($selectOrAll == 1) {
            foreach ($results as $result) {
                $buildings .= "<option id='{$result['id']}' value='{$result['building_name']}'>{$result['building_name']}</option>";
            }
            return $buildings;
        } else {
            return $results;
        }
    }

    function deleteBuilding($id)
    {
        if($this->BuildingModel->where(array('id' => $id))->delete()) {
            return(true);
        } else {
            return(false);
        }
    }

    function editBuilding(array $attributes)
    {
        $id = $attributes['id'];
        $buildingName = $attributes['building_name'];

        $attribute = [
            'building_name' => $buildingName
        ];

        if($this->BuildingModel->where('id', $id)->update($attribute)){
            return(true);
        } else {
            return(false);
        }
    }

    public function editRoom(array $attributes)
    {
        $id = $attributes['id'];

        $room_name = $attributes['room_name'];
        $room_seats = $attributes['room_seats'];
        $building_id = $attributes['building_id'];

        $attribute = [
            'room_name' => $room_name,
            'room_seats' => $room_seats,
            'building_id' => $building_id
        ];

        if($this->RoomBookingModel->where('id', $id)->update($attribute)){
            return(true);
        } else {
            return(false);
        }

    }

    function deleteRoom($id)
    {
        if($this->RoomBookingModel->where(array('id' => $id))->delete()) {
            return(true);
        } else {
            return(false);
        }    }

    function addBooking(array $attributes)
    {

    }
}