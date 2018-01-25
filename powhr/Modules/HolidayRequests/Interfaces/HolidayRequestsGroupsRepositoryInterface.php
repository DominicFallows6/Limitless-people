<?php

namespace Powhr\Modules\HolidayRequests\Interfaces;

interface HolidayRequestsGroupsRepositoryInterface
{

    public function getAll(array $args = []);

    public function saveData(\Powhr\Modules\HolidayRequests\Data\HolidayRequestGroupDataObject $holidayRequestGroupDataObject);

    public function getRequestsForStaff($id, $year);

    public function getRequest($id);

}