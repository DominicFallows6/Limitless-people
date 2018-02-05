<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 28/10/2016
 * Time: 11:36
 */

namespace Powhr\Modules\RoomBooking\Interfaces;

interface RoomBookingInterface
{

    public function RoomInformation($Id);

    public function Rooms();

    public function getAllRooms();

    public function getMoreRooms($Id);

    public function addRoom(array $attributes);

    public function deleteRoom($id);

    public function editRoom(array $attributes);

}