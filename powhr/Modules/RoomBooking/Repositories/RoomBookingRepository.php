<?php
/**
 * Created by PhpStorm.
 * User: dfallows
 * Date: 30/01/2018
 * Time: 14:30
 */

namespace Powhr\Modules\RoomBooking\Repositories;

use Powhr\Models\UserModel;
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

    public function __construct(
        array $attributes = [],
        UserModel $userModel,
        BuildingModel $BuildingModel,
        RoomBookingModel $RoomBookingModel,
        Business $businessModel,
        RoomBookingBookingsModel $roomBookingBookingsModel
    )
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

        if($data['roomId'] != null){
            $query = $this->roomBookingBookingsModel->select([
                'room_bookings.requested_time',
                'room_bookings.requested_time_end',
                'room_bookings.requested_date',
                'room_bookings.requested_date_end',
                'room_bookings.user_id',
                'room_information.room_name',
                'room_information.id'
            ]);
            $query->leftJoin('room_information', 'room_bookings.room_information_id', '=', 'room_information.id');
            $query->where('room_information.building_id', '=', $data['buildingId']);
            $query->where('room_information.id', '=', $data['roomId']);
            $results = $query->get()->toArray();

            foreach ($results as $key => $result) {
                $query = $this->userModel->select('first_name', 'surname');
                $query->where('id', '=', $result['user_id']);
                $users = $query->get()->toArray();
                $userName = $users[0]['first_name'] . ' ' . $users[0]['surname'];
                $results[$key]['user_id'] = $userName;
            }

            return $results;
        }else {
            $query = $this->roomBookingBookingsModel->select([
                'room_bookings.requested_time',
                'room_bookings.requested_time_end',
                'room_bookings.requested_date',
                'room_bookings.requested_date_end',
                'room_bookings.user_id',
                'room_information.room_name',
                'room_information.id'
            ]);
            $query->leftJoin('room_information', 'room_bookings.room_information_id', '=', 'room_information.id');
            $query->where('room_information.building_id', '=', $data['buildingId']);
            $results = $query->get()->toArray();

            foreach ($results as $key => $result) {
                $query = $this->userModel->select('first_name', 'surname');
                $query->where('id', '=', $result['user_id']);
                $users = $query->get()->toArray();
                $userName = $users[0]['first_name'] . ' ' . $users[0]['surname'];
                $results[$key]['user_id'] = $userName;
            }

            return $results;
        }

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

    function addArea(array $attributes)
    {
        $this->BuildingModel->building_name = $attributes['building_name'];

        if ($this->BuildingModel->save()) {
            return (true);
        } else {
            return (false);
        }
    }

    function getArea($selectOrAll)
    {
        $query = $this->BuildingModel->select('*');
        $results = $query->get()->toArray();
        $buildings = '';

        if ($selectOrAll == 1) {
            foreach ($results as $result) {
                $buildings .= "<option id='{$result['id']}' value='{$result['building_name']}'>{$result['building_name']}</option>";
            }
            return $buildings;
        } else {
            return $results;
        }
    }

    function getRooms($selectOrAll, $id)
    {
        $query = $this->RoomBookingModel->select('*');
        $query->where('building_id', '=', $id);
        $results = $query->get()->toArray();
        $rooms = '';

        if (count($results) > 1) {
            if ($selectOrAll == 1) {
                foreach ($results as $result) {
                    $rooms .= "<option id='{$result['id']}' value='{$result['room_name']}'>{$result['room_name']}</option>";
                }
                return $rooms;
            } else {
                return $results;
            }
        } else {
            $rooms .= "<option id='no_room' selected disabled value='No rooms'>No rooms</option>";
            return $rooms;
        }

    }

    function deleteBuilding($id)
    {
        if ($this->BuildingModel->where(array('id' => $id))->delete()) {
            return (true);
        } else {
            return (false);
        }
    }

    function editBuilding(array $attributes)
    {
        $id = $attributes['id'];
        $buildingName = $attributes['building_name'];

        $attribute = [
            'building_name' => $buildingName
        ];

        if ($this->BuildingModel->where('id', $id)->update($attribute)) {
            return (true);
        } else {
            return (false);
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

        if ($this->RoomBookingModel->where('id', $id)->update($attribute)) {
            return (true);
        } else {
            return (false);
        }

    }

    function deleteRoom($id)
    {
        if ($this->RoomBookingModel->where(array('id' => $id))->delete()) {
            return (true);
        } else {
            return (false);
        }
    }

    function addBooking(array $attributes)
    {
        $this->roomBookingBookingsModel->user_id = $attributes['user_id'];
        $this->roomBookingBookingsModel->room_information_id = $attributes['room_information_id'];
        $this->roomBookingBookingsModel->requested_date = $attributes['requested_date'];
        $this->roomBookingBookingsModel->requested_date_end = $attributes['requested_date_end'];
        $this->roomBookingBookingsModel->requested_time = $attributes['requested_time'];
        $this->roomBookingBookingsModel->requested_time_end = $attributes['requested_time_end'];

        if ($this->roomBookingBookingsModel->save()) {
            return ('true');
        } else {
            return ('false');
        }

    }

    function getBookingRoomId($id, $id1)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = $this->RoomBookingModel->select('id');
        $query->where('room_name', '=', $id);
        $query->where('building_id', '=', $id1);
        $results = $query->get()->toArray();
        return $results;
    }
}