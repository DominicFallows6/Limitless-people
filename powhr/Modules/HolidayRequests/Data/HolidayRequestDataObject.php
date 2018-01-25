<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 27/10/2016
 * Time: 21:00
 */

namespace Powhr\Modules\HolidayRequests\Data;

use Powhr\Modules\HolidayRequests\Interfaces\HolidayRequestsGroupsRepositoryInterface;


class HolidayRequestDataObject
{

    private $initData = [];
    private $holidayRequestGroup;
    private $formattedDate;


    /**
     * Factory Method for creating a holiday request data object
     *
     * @param array $initData
     * @param HolidayRequestsGroupsRepositoryInterface $holidayRequestGroup
     * @return $this
     */
    public function createFromPost(array $initData, HolidayRequestsGroupsRepositoryInterface $holidayRequestGroup){

        $this->initData = $initData;
        $this->holidayRequestGroup = $holidayRequestGroup;

        return $this;

    }

    public function getRequestedDate()
    {
        if (isset($this->initData ['one_off'])) {
            //encoded to remove badly encoded string from vendor package and ajax request
            $encoded = json_encode($this->initData['requested_date']);
            $encoded = str_replace('\u00a0', ' ', $encoded);
            $encoded = str_replace('"', '', $encoded);
            $formattedDate = $encoded;
            $this->formattedDate = date('Y-m-d', strtotime($formattedDate));
            return $this->formattedDate;
        } else {
            return date('Y-m-d', strtotime($this->initData['requested_date']));
        }
    }

    public function getUserId()
    {
        return $this->holidayRequestGroup->user_id;
    }

    public function getPeriod()
    {
        return $this->initData['period_choice'];
    }

    public function getHolidayRequestGroupId()
    {
        return $this->holidayRequestGroup->id;
    }

    public function getDuration()
    {
        if (isset($this->initData['duration'])) {
            return $this->initData['duration'];
        } else {
            return 1;
        }
    }

}