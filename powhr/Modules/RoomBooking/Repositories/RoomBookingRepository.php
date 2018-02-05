<?php
/**
 * Created by PhpStorm.
 * User: dfallows
 * Date: 30/01/2018
 * Time: 14:30
 */

namespace Powhr\Modules\RoomBooking\Repositories;

use Powhr\Models\User;
use Powhr\Models\PowhrEloquentModel;
use Powhr\Modules\RoomBooking\Interfaces\RoomBookingInterface;

class RoomBookingRepository extends PowhrEloquentModel implements RoomBookingInterface
{

    protected $userModel;
    protected $table = 'room_information';

    public function __construct(array $attributes = [], User $userModel)
    {
        parent::__construct($attributes);
        $this->userModel = $userModel;
    }

    public function roomInformation($Id)
    {
        /** @var \Illuminate\Database\Query\Builder $query */

        $query = $this->userModel->select(['*']);
        $query->from('room_information');
        $query->where('id', '=', $Id);
        $results = $query->get();

        return $results;
    }

    public function getAllRooms()
    {
        /** @var \Illuminate\Database\Query\Builder $query */

        $query = $this->userModel->select(['*']);
        $query->from('room_information');
        $results = $query->get();

        return $results;
    }

    public function Rooms()
    {
        /** @var \Illuminate\Database\Query\Builder $query */

        $query = $this->userModel->select(['*']);
        $query->from('room_information');
        $query->where('building_id', '=', '1');
        $results = $query->get();

        return $results;
    }

    public function getMoreRooms($Id)
    {
        /** @var \Illuminate\Database\Query\Builder $query */

        $query = $this->userModel->select(['*']);
        $query->from('room_information');
        $query->where('building_id', '=', $Id);
        $results = $query->get();

        return $results;
    }

    public function addRoom(array $attributes)
    {
        $this->room_name = $attributes['room_name'];
        $this->room_seats = $attributes['room_seats'];
        $this->building_id = $attributes['building_id'];
        if($this->save()){
           return(true);
        } else {
          return(false);
        }
    }

    public function deleteRoom($id)
    {
        if($this->where(array('id' => $id))->delete()) {
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

        if($this->where('id', $id)->update($attribute)){
            return(true);
        } else {
            return(false);
        }

    }
}