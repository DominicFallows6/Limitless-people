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
    function roomInformationNames(array $data);

    function getArea();

    function addRoom(array $attributes);

    function addArea(array $attributes);

    function getAllRooms();
}