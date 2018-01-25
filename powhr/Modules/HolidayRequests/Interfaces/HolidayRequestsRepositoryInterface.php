<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 28/10/2016
 * Time: 11:36
 */

namespace Powhr\Modules\HolidayRequests\Interfaces;

use Powhr\Modules\HolidayRequests\Data\HolidayRequestDataObject;

interface HolidayRequestsRepositoryInterface
{

    public function saveData(HolidayRequestDataObject $holidayRequestDataObject);

    public function holidayRequestGroup();

    public function getDates(array $args);

    public function getTeamDates(array $args);

    public function getRequestData(array $args);

    public function getBalances(array $args);

    public function getManagementOverview(array $args);

    public function deleteRequestDate ($id, $userID);

}