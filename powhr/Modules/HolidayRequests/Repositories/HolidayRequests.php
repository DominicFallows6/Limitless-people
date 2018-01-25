<?php

namespace Powhr\Modules\HolidayRequests\Repositories;
use Illuminate\Database\Eloquent\Model;
use Powhr\Modules\HolidayRequests\Data\HolidayRequestDataObject;
use Powhr\Modules\HolidayRequests\Interfaces\HolidayRequestsRepositoryInterface;

class HolidayRequests extends Model implements HolidayRequestsRepositoryInterface
{

    protected $table = 'holiday_requests';

    /**
     * @param HolidayRequestDataObject $holidayRequestDataObject
     * @return $this
     */
    public function saveData(HolidayRequestDataObject $holidayRequestDataObject) {

        $this->requested_date = $holidayRequestDataObject->getRequestedDate();
        $this->user_id = $holidayRequestDataObject->getUserId();
        $this->period = $holidayRequestDataObject->getPeriod();
        $this->holiday_request_group_id = $holidayRequestDataObject->getHolidayRequestGroupId();
        $this->duration = $holidayRequestDataObject->getDuration();
        $this->save();

        return $this;

    }

    /**
     * @deprecated todo remove reliance of eloquent relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function holidayRequestGroup()
    {
        return $this->belongsTo('\Powhr\Modules\HolidayRequests\Models\HolidayRequestGroups');
    }
    
    public function calculateTotalHoliday($dateArray) {
        
        $workDays = array();

        foreach ($dateArray AS $keyDate => $valueDate) {
            $dayOfWeek = $valueDate->format('N');
            $date = $valueDate->format('Y-m-d');
            if ($dayOfWeek != '6' && $dayOfWeek != '7' && !in_array($date, $this->bankHols)) {
                $workDays[] = $valueDate;
            }
        }
        
        return $this->duration = count($workDays);
        
    }

    public function getDates(array $args = array())
    {
        $flatDates = array();

        $sql = "SELECT hr.id AS date_id, hr.user_id, duration, requested_date, authorised_by, DATE_FORMAT(requested_date, '%d') AS day_choice, start, end, one_off, holiday_request_type_name, counts_as_leave FROM holiday_requests AS hr inner join holiday_request_groups ON holiday_request_group_id = holiday_request_groups.id INNER JOIN holiday_request_types ON holiday_request_type_id = holiday_request_types.id

WHERE hr.id > 0";

        if (!empty($args['user_id'])){
            $sql .= ' AND hr.user_id = '.$args['user_id'];
        }

        if (!empty($args['month']) && !empty($args['year'])) {
            $sql .= ' AND (requested_date >= \''.$args['year'].'-'.$args['month'].'-01\' AND requested_date <= \''.$args['year'].'-'.$args['month'].'-31\')';
        }

        if ($requests = \DB::select($sql)) {

            foreach ($requests as $key => $request) {

                if ($request->counts_as_leave == 0) {
                     $class = 'working_absence';
                } elseif ($request->authorised_by == 0) {
                    $class = 'date_awaiting_authorisation';
                } elseif ($request->authorised_by == -1) {
                    $class = 'date_not_authorised';
                } else {
                    $class = 'date_authorised';
                }

                if ($request->duration == 0.5) {
                    $class .= ' half_date_request';
                }

                $newDateKey = ltrim($request->day_choice,0);

                $flatDates[$newDateKey] = '<div class="date_added '.$class.'"><a href="javascript:;">'.$newDateKey.'</a><span class="holiday_request_date_id">'.$request->date_id.'</span></div>';

            }

        }

        return($flatDates);

    }

    public function getTeamDates(array $args = array())
    {
        $requests = array();

        $sql = "SELECT u.first_name, u.email, u.surname, hr.id AS date_id, hr.user_id, duration, requested_date, authorised_by, DATE_FORMAT(requested_date, '%d') AS day_choice, start, end, one_off, counts_as_leave, hr.period
        FROM holiday_requests AS hr 
        INNER JOIN holiday_request_groups ON holiday_request_group_id = holiday_request_groups.id
        INNER JOIN holiday_request_types ON holiday_request_type_id = holiday_request_types.id
        INNER JOIN users AS u ON hr.user_id = u.id
        WHERE hr.id > 0";

        $userIDs = '';

        if (!empty($args['team_ids'])) {
            $userIDs = $args['team_ids'];
        }

        if (!isset($args['user_status_id'])) {
            $user_status_id = \Powhr\Models\User::ACTIVE_USER_ID;
        }

        $sql .= ' AND hr.user_id IN ('.$userIDs.') AND u.user_status_id = '.$user_status_id;

        if (!empty($args['month']) && !empty($args['year'])) {
            $sql .= ' AND (requested_date >= \''.$args['year'].'-'.$args['month'].'-01\' AND requested_date <= \''.$args['year'].'-'.$args['month'].'-31\')';
        }

        if ($requests = \DB::select($sql)) {
            return ($requests);
        }

    }

    /**
     * Supplies a list of holiday request dates dependent upon array passed
     *
     * @param array $args
     * @return mixed
     */
    public function getRequestData(array $args = array())
    {

        $sql = "SELECT hr.id AS request_id, requested_date, CONCAT(staff.first_name, ' ' ,staff.surname) AS staff_member, CONCAT(superior.first_name, ' ' ,superior.surname) AS superior_name, DATE_FORMAT(requested_date, '%W %D %M %Y') AS formatted_request_date, staff.superior_id, authorised_by, DATE_FORMAT(hr.created_at, '%W %D %M %Y') AS formatted_creation_date, duration, start, end, one_off, hr.user_id, counts_as_leave, needs_approval, hr.period, holiday_request_type_name
        
        FROM `holiday_requests` AS hr
        INNER JOIN holiday_request_groups ON holiday_request_group_id = holiday_request_groups.id
        INNER JOIN users AS staff ON hr.user_id = staff.id
        INNER JOIN holiday_request_types ON holiday_request_type_id = holiday_request_types.id
        LEFT JOIN users AS superior ON authorised_by = superior.id WHERE hr.id > 0";

        if (isset($args['superior_id'])) {
            $sql .= ' AND staff.superior_id = '.$args['superior_id'];
        }

        if (isset($args['user_id'])) {
            $sql .= ' AND hr.user_id = '.$args['user_id'];
        }

        if (isset($args['id'])) {
            $sql .= ' AND hr.id = '.$args['id'];
        }

        if (isset($args['authorised'])) {
            $sql .= ' AND authorised_by > 0';
        }

        if (isset($args['awaiting'])) {
            $sql .= ' AND authorised_by = 0';
        }

        $sql .= " ORDER BY requested_date DESC";

        if (isset($args['single'])) {
            $requests = \DB::select($sql)[0];
        } else {
            $requests = \DB::select($sql);
        }

        return $requests;

    }

    /**
     * Gets the holiday balances for user(s)
     * @param array $args
     * @return mixed
     */
    public function getBalances(array $args = array())
    {

        $yearStringStart = $args['calendar_year'] .'-01-01';
        $yearStringEnd = $args['calendar_year'] .'-12-31';

        $sql = "SELECT staff.id, username, email, organisation_unit_name, business_name, default_days_leave, bonus_days, (default_days_leave+bonus_days) AS total_leave, (SELECT COALESCE(SUM(duration),0) FROM holiday_requests AS hr INNER JOIN holiday_request_groups ON holiday_request_group_id = holiday_request_groups.id INNER JOIN holiday_request_types ON holiday_request_type_id = holiday_request_types.id WHERE counts_as_leave = 1 AND authorised_by > 0 AND hr.user_id = staff.id AND (requested_date >= '{$yearStringStart}' AND requested_date <= '{$yearStringEnd}')) AS authorised_days, (SELECT SUM(duration) FROM holiday_requests AS hr INNER JOIN holiday_request_groups ON holiday_request_group_id = holiday_request_groups.id INNER JOIN holiday_request_types ON holiday_request_type_id = holiday_request_types.id WHERE counts_as_leave = 1 AND authorised_by = 0 AND hr.user_id = staff.id AND (requested_date >= '{$yearStringStart}' AND requested_date <= '{$yearStringEnd}')) AS awaiting_days, ((default_days_leave+bonus_days) - (SELECT COALESCE(SUM(duration),0) FROM holiday_requests AS hr INNER JOIN holiday_request_groups ON holiday_request_group_id = holiday_request_groups.id INNER JOIN holiday_request_types ON holiday_request_type_id = holiday_request_types.id WHERE counts_as_leave = 1 AND authorised_by > 0 AND hr.user_id = staff.id AND (requested_date >= '{$yearStringStart}' AND requested_date <= '{$yearStringEnd}'))) AS balance FROM users AS staff INNER JOIN organisation_units AS ou ON staff.organisation_unit_id = ou.id INNER JOIN business ON ou.business_id = business.id WHERE staff.id > 0";

        if (isset($args['user_id'])) {
            $sql .= ' AND staff.id = '.$args['user_id'];
        }

        if (isset($args['business_id'])) {
            $sql .= " AND business_id = ". $args['business_id'];
        }

//        echo $sql;
        
        if (isset($args['single'])) {
            $requests = \DB::select($sql)[0];
        } else {
            $requests = \DB::select($sql);
        }

        return $requests;

    }

    /**
     * Gets user list with various count info
     *
     * @param array $args
     * @return mixed
     */
    public function getManagementOverview(array $args = array())
    {

        $yearStartString = $args['year'].'-01-01';
        $yearEndString = $args['year'].'-12-31';
        
        //checks for business id and UserID
        //may return false if neither present for security
        if (!isset($args['business_id']) || !isset($args['superior_id'])) {
            return false;
        }

        if (!isset($args['user_status_id'])) {
            $user_status_id = \Powhr\Models\User::ACTIVE_USER_ID;
        }

        $users = $args['superior_id'];

        $sql = "SELECT u.id, u.first_name, u.superior_id, u.surname, u.email, organisation_unit_name, default_days_leave, u.bonus_days, (SELECT count(hrg.id) FROM holiday_request_groups AS hrg INNER JOIN holiday_request_types ON holiday_request_type_id = holiday_request_types.id WHERE needs_approval = 1 AND awaiting_auth = ".\Powhr\Modules\HolidayRequests\Module::AWAITING_AUTH." AND user_id = u.id AND (start >= '{$yearStartString}' AND start <= '{$yearEndString}')   ) AS hr_group_awaiting, (SELECT (default_days_leave+u.bonus_days) - (SELECT COALESCE(SUM(duration),0) FROM holiday_requests AS subhr INNER JOIN holiday_request_groups ON holiday_request_group_id = holiday_request_groups.id INNER JOIN holiday_request_types ON holiday_request_type_id = holiday_request_types.id WHERE counts_As_leave = 1 AND authorised_by > 0 AND subhr.user_id = u.id AND (requested_date >= '{$yearStartString}' AND requested_date <= '{$yearEndString}'))) AS balance

        FROM `users` AS u
        JOIN users AS superior ON u.superior_id = superior.id
        JOIN organisation_units AS ou ON u.organisation_unit_id = ou.id 
        INNER JOIN business ON ou.business_id = business.id
        
        WHERE u.id > 0 AND u.user_status_id = ".$user_status_id;

        $sql .= " AND business_id = " . $args['business_id'];
        $sql .= " AND u.superior_id IN ({$users})";
        
        $requests = \DB::select($sql);

        return $requests;

    }
    
    public function deleteRequestDate($id, $userID)
    {
        $this->where(array('id' => $id))->delete();
    }

    public function updateRequest($holidayRequestGroupID, $authorisation)
    {
        $this->where('holiday_request_group_id', '=', $holidayRequestGroupID)->update(['authorised_by' => $authorisation]);
    }

}
