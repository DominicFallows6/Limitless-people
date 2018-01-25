<?php

namespace Powhr\Modules\HolidayRequests\Controllers;
use Powhr\Contracts\Notifier;
use Powhr\Contracts\PublicAssetsInterface;
use Powhr\Models\User;
use Powhr\Modules\HolidayRequests\Data\HolidayRequestDataObject;
use Powhr\Modules\HolidayRequests\Data\HolidayRequestGroupDataObject;
use Powhr\Modules\HolidayRequests\Interfaces\HolidayRequestsGroupsRepositoryInterface;
use Powhr\Modules\HolidayRequests\Interfaces\HolidayRequestsRepositoryInterface;
use Powhr\Modules\HolidayRequests\Module;
use Powhr\Modules\HolidayRequests\Services\DateProcessor;
use Powhr\Modules\HolidayRequests\Services\RequestNotificationProcessor;

class HolidayRequestController extends Module
{

    protected $request;
    protected $holidayRequestsGroup;
    protected $notifier;
    protected $hr;
    /**
     * @var DateProcessor
     */
    private $dateProcessor;
    /**
     * @var HolidayRequestRepository
     */
    private $holidayRequestRepository;

    function __construct(
        \Illuminate\Http\Request $request,
        HolidayRequestsGroupsRepositoryInterface $holidayRequestsGroupsRepository,
        Notifier $notifier,
        PublicAssetsInterface $publicAssets,
        DateProcessor $dateProcessor,
        HolidayRequestsRepositoryInterface $holidayRequestRepository
    ) {

        $this->notifier = $notifier;
        $this->holidayRequestsGroup = $holidayRequestsGroupsRepository;
        $this->hr = $holidayRequestRepository;
        $this->dateProcessor = $dateProcessor;
        $this->holidayRequestRepository = $holidayRequestRepository;

        //this is done here as I need it to be shared across many views
        \View::share('module_global_vars', array('calendar_years' => $dateProcessor->createCalendarYears()));

        parent::__construct($request, $publicAssets);


    }

    function getBalances()
    {
        $year = $this->request->input('calendar_year', date('Y'));
        $userID = $this->userID;

        if (is_numeric($this->request->segment(4))) {
            $userID = $this->request->segment(4);
        }

        $data['holidayBalances'] = $this->hr->getBalances(array(
            'business_id' => $this->userBusinessID,
            'user_id' => $userID,
            'single' => true,
            'calendar_year' => $year
        ));

        $data['calendar_year'] = $year;
        return \View::make('holidayBalances')->with('data', $data);

    }

    function getMyRequests(\Powhr\Modules\HolidayRequests\Models\HolidayRequestTypes $holidayRequestTypes, User $user)
    {

        $data['type_options'] = $holidayRequestTypes->getRequestsTypes();
        $data['user_id'] = $this->userID;

        if (is_numeric($this->request->segment(4))) {
            $data['user_id'] = $this->request->segment(4);
            $data['viewing_as_user'] = true;
        }

        $data['viewable_user'] = $user->getItem($data['user_id']);

        if (\Request::ajax()) {

            $data['calendarMonth'] = \Input::get('month');
            $data['calendarYear'] = \Input::get('year');
            $data['requests'] = $this->hr->getDates(array(
                'user_id' => $data['user_id'],
                'month' => $data['calendarMonth'],
                'year' => $data['calendarYear']
            ));
            return \View::make('holidayCalendar')->with('data', $data);

        } else {

            $data['calendarMonth'] = date('m');
            $data['calendarYear'] = date('Y');
            $data['requests'] = $this->hr->getDates(array(
                'user_id' => $data['user_id'],
                'month' => $data['calendarMonth'],
                'year' => $data['calendarYear']
            ));

            return \View::make('yourHolidayRequests')->with('data', $data);

        }

    }

    function getDateDetails()
    {
        $segment = \Request::segment(3);

        if (is_numeric($segment)) {

            $data = $this->hr->getRequestData(array('id' => $segment, 'single' => true));

            //todo move to centralised function - for multiple rules
            $today = $date1 = new \DateTime('now');
            $dateOfRequest = new \DateTime($data->requested_date);

            $superiors = explode(',', $this->request->session()->get('reporting_staff_ids', '0'));

            //remove current user
            if(($key = array_search($this->request->user()->id, $superiors)) !== false) {
                unset($superiors[$key]);
            };

            if ($data->needs_approval == 0) {
                $data->canDelete = 1;
            } elseif (in_array($data->user_id, $superiors)) {
                $data->canDelete = 1;
            } elseif ($today < $dateOfRequest) {
                $data->canDelete = 1;
            } elseif ($data->authorised_by == -1) {
                $data->canDelete = 0;
            } else {
                $data->canDelete = 0;
            }

            return \View::make('holidayRequestData')->with('data', $data);

        }

    }

    function getDeleteRequest()
    {
        if (is_numeric(\Request::segment(3))) {

            $id = \Request::segment(3);

            $userID = $this->userID;
            $this->holidayRequestRepository->deleteRequestDate($id, $userID);

            echo json_encode(['response'=>'success']);

        }
    }

    function getUserRequests(\Powhr\Services\User $serviceUser)
    {

        $year = $this->request->input('year', date('Y'));
        $scope = $this->request->input('direct_report', $this->request->user()->id);

        if ($scope == '0') {
            $scopeIDs = $this->request->session()->get('reporting_staff_ids', '0');
        } else {
            $scopeIDs = $this->request->user()->id;
        }

        $data = [];
        $data['calendar_years'] = $this->dateProcessor->createCalendarYears('Select Year...');

        $data['userList'] = $this->hr->getManagementOverview(array(
            'business_id' => $this->userBusinessID,
            'superior_id' => $scopeIDs,
            'year' => $year,
        ));

        $data['user_scope'] = [$this->request->user()->id=>'Direct Reporters', '0'=>'View All'];

        return \View::make('userList')->with('data', $data);

    }

    function getRequestsForStaff($id)
    {
        $data = [];
        $year = $this->request->input('calendar_year', date('Y'));
        $data['holidayRequests'] = $this->holidayRequestsGroup->getRequestsForStaff($id, $year);
        return \View::make('staffHolidayRequestList')->with('data', $data);
    }

    function postSaveRequest(
        HolidayRequestGroupDataObject $groupDataObject,
        HolidayRequestDataObject $holidayRequestDataObject,
        RequestNotificationProcessor $requestNotificationProcessor
    ){
        $initData = \Input::all();

        $rules = array(
            'requested_date' => 'required',
            'duration' => 'required|numeric',
            'period_choice' => 'required',
            'user_id' => 'required|numeric'
        );

        $validator = \Validator::make($initData, $rules);


        if ($validator->passes()) {

            $initData['one_off'] = 1;

            $groupData = array (
                'start' => $initData['requested_date'],
                'user_id' => $initData['user_id'],
                'duration_type' => $initData['duration'],
                'period' => $initData['period_choice'],
                'holiday_request_type_id' => $initData['holiday_request_type_id'],
                'one_off' => 1
            );

            $hrgData = $groupDataObject->createFromPost($groupData);
            $hrgObject = $this->holidayRequestsGroup->saveData($hrgData);
            $hrData = $holidayRequestDataObject->createFromPost($initData, $hrgObject);
            $this->hr->saveData($hrData);

            $requestNotificationProcessor->sendRequestNotification($hrgObject->id);

            echo json_encode(array('result' => 'success'));

        } else {
            return \Redirect::to('dashboard/')->withInput()->withErrors($validator);
        }

    }

    function postMultipleDates(HolidayRequestGroupDataObject $groupDataObject, RequestNotificationProcessor $requestNotificationProcessor)
    {

        $this->validate($this->request, array(
            'requested_dates'=> 'required',
            'user_id'=>'required|numeric'
        ));

        $userID = $this->request->input('user_id');

        $processedDates = $this->dateProcessor->convertDatesFromStringToArray($_POST['requested_dates']);

        $holidayRequestGroupDataObject = $groupDataObject->createFromMultipleDatePost($userID, $this->request->get('holiday_request_type_id'), $processedDates);
        $hrgObject = $this->holidayRequestsGroup->saveData($holidayRequestGroupDataObject);

        foreach ($processedDates AS $key => $date) {

            /** @var \Powhr\Modules\HolidayRequests\Repositories\HolidayRequests $newHR */
            $newHR = $this->hr->newInstance();

            $hrDataObject = new HolidayRequestDataObject();

            $hrData = $hrDataObject->createFromPost(
                array(
                    'requested_date' => $date,
                    'user_id' => $userID,
                    'period_choice' => 'NA'
                ), $hrgObject);

            $newHR->saveData($hrData);

        }

        $requestNotificationProcessor->sendRequestNotification($hrgObject->id);

        echo json_encode(array('result' => 'success'));

    }

    public function anyRequestResponse(RequestNotificationProcessor $requestNotificationProcessor)
    {

        $data = \Input::all();

        $rules = array(
            'requestId' => 'required|numeric',
            'responseType' => 'required|numeric'
        );

        $validator = \Validator::make($data, $rules);

        if ($validator->passes()) {

            //save to child records
            if ($data['responseType'] == 1) {
                $authorisation = $this->userID;
            } else {
                $authorisation = -1;
            }

            //save to parent group
            $holidayRequestGroup = $this->holidayRequestsGroup->updateRequestGroup($data['requestId'], array('awaiting_auth'=>$authorisation, 'period'=>'NA'));

            //update all children
            $this->holidayRequestRepository->updateRequest($data['requestId'], $authorisation);

            //send notification
            $requestNotificationProcessor->sendResponseNotification($holidayRequestGroup->id);

            echo json_encode(array('response' => 'success'));

        }

    }

    public function getTeamView()
    {

        $data = [];

        if ($month = \Input::get('month')) {
            $data['calendarMonth'] = $month;
        } else {
            $data['calendarMonth'] = date('m');
        }

        if ($year = \Input::get('year')) {
            $data['calendarYear'] = $year;
        } else {
            $data['calendarYear'] = date('Y');
        }

        $data['requests'] = $this->dateProcessor->getTeamDates(\Auth::user()->id, $data);

        return \View::make('teamCalendar')->with('data', $data);

    }

    public function getDownloadData()
    {
        $this->authorize('access_action', [1, self::MODULE_ID]);
    }

}

?>