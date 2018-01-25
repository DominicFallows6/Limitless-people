<?php

namespace Powhr\Modules\HolidayRequests\Data;

use Powhr\Modules\HolidayRequests\Module;

class HolidayRequestGroupDataObject
{

    private $data = [];
    private $formattedDate;
    private $datesArray;
    
    
    public function createFromPost(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Factory Method for creating an Holiday Request Object For Multiple Dates From Post
     * 
     * @param $userID
     * @param $holidayRequestTypeId
     * @param $datesArray
     * @return $this
     */
    public function createFromMultipleDatePost($userID, $holidayRequestTypeId, $datesArray)
    {
  
        $this->data['start'] = date('Y-m-d', strtotime($datesArray[0]));
        $this->data['end'] = date('Y-m-d', strtotime(end($datesArray)));
        $this->data['duration_type'] = 1;
        $this->data['day_count'] = count($datesArray);
        $this->data['holiday_request_type_id'] = $holidayRequestTypeId;
        $this->data['user_id'] = $userID;
        $this->data['period'] = 'NA';

        return $this;
        
    }

    public function getStart()
    {
        //encoded to remove badly encoded string from vendor package and ajax request
        if (isset($this->data['one_off'])) {
            $encoded = json_encode($this->data['start']);
            $encoded = str_replace('\u00a0', ' ', $encoded);
            $encoded = str_replace('"', '', $encoded);
            $formattedDate = $encoded;
            $this->formattedDate = date('Y-m-d', strtotime($formattedDate));
            return $this->formattedDate;
        } else {
            return $this->data['start'];
        }
    }
    
    public function getEnd()
    {
        if (isset($this->data['one_off'])){
            return $this->formattedDate;
        } else {
            return $this->data['end'];
        }
    }

    public function getUserId()
    {
        return $this->data['user_id'];
    }

    public function getOneOffStatus()
    {
        return 1;
    }

    public function getAwaitingAuth() {
        return Module::AWAITING_AUTH;
    }

    public function getDurationType()
    {
        return $this->data['duration_type'];
    }

    public function getDayCount()
    {
        if (isset($this->data['day_count'])) {
            return $this->data['day_count'];
        } else {
            return 1;
        }
    }

    public function getPeriod()
    {
        return $this->data['period'];
    }

    public function getHolidayRequestTypeId()
    {
        return $this->data['holiday_request_type_id'];
    }

}