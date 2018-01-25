<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 16/08/2016
 * Time: 13:56
 */

namespace powhr\Modules\HolidayRequests\Services;

use Powhr\Models\User;
use Powhr\Modules\HolidayRequests\Interfaces\HolidayRequestsRepositoryInterface;

/**
 * Utility Class DateProcessor
 * @package powhr\Modules\HolidayRequests\Services
 */
class DateProcessor
{

    /** @var \Powhr\Models\User */
    private $user;

    function __construct(HolidayRequestsRepositoryInterface $hr, \Powhr\Models\User $user)
    {
        $this->hr = $hr;
        $this->user = $user;
    }

    /**
     * Gets and processes the dates for the team viewer
     * @param $userID
     * @param $temporalData
     * @return bool
     * @internal param $teamIDs
     * @internal param $data
     */
    function getTeamDates($userID, $temporalData)
    {

        /** @var User $user */
        $user = $this->user->findOrFail($userID);
        $teamIDs = $user->getUserSiblings();

        if ($requests = $this->hr->getTeamDates(
            array(
                'team_ids'=>$teamIDs,
                'month'=>$temporalData['calendarMonth'],
                'year'=>$temporalData['calendarYear']
            ))
        ) {

            foreach ($requests as $key => $request) {

                if ($request->counts_as_leave == 0) {
                    $class = 'team_date_working_absence';
                } elseif ($request->authorised_by == 0) {
                    $class = 'team_date_awaiting_authorisation';
                } elseif ($request->authorised_by == -1) {
                    $class = 'team_date_not_authorised';
                } else {
                    $class = 'team_date_authorised';
                }

                if ($request->duration == 0.5) {
                    $extra = '<strong> - '. strtoupper($request->period).'</strong>';
                } else {
                    $extra = '';
                }

                $newDateKey = ltrim($request->day_choice, 0);

                //check if exists or apends string
                if (isset($flatDates[$newDateKey])) {
                    $flatDates[$newDateKey] .= '<div class="team_date_added '.$class.'">'.$request->first_name.' '.$request->surname.$extra.'</div>';
                } else {
                    $flatDates[$newDateKey] = '<div class="team_date_added '.$class .'">'.$request->first_name.' '.$request->surname.$extra.'</div>';
                }

            }

            return $flatDates;

        } else {

            return false;

        }
    }

    //hardcoded at the moment, but can be made dynamically quite easily
    function createCalendarYears($textForInstruction = '')
    {
        $years = [];

        if (!empty($textForInstruction)) {
            $years[''] = $textForInstruction;
        }

        $years[2016] = 2016;
        $years[2017] = 2017;

        return $years;
    }

    /**
     * Calculate Dates Between 2 DateTime Objects
     *
     * @param DateTime $date1
     * @param DateTime $date2
     * @param bool|false $inclusive
     * @return array
     */
    function datesBetween(DateTime $date1, DateTime $date2, $inclusive = false) {

        $dates = array();

        $period = new DatePeriod(
            $date1,
            new DateInterval('P1D'),
            $date2
        );

        foreach ($period AS $k => $v) {
            $dates[] = $v;
        }

        if ($inclusive) {
            $dates[] = $date2;
        }

        return $dates;

    }

    function convertDatesFromStringToArray($dateString)
    {
        //todo could remove &nbsp here and pass data
        $datesArray = explode('<br>', rtrim($_POST['requested_dates'], '<br />'));

        //remove &nsbp; as we need first and last values
        $santisedDates = array_map(function ($value) {
            return str_replace('&nbsp;', ' ', $value);
        }, $datesArray);

        return $santisedDates;

    }

}