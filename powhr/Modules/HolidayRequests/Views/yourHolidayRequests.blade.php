@extends('layouts.base')

@section('body')

    @include('attendanceTypeOptions')

    <div style="display: none;">
        <span id="viewing_user">{{$data['user_id']}}</span>
        <span id="page_base_url">/{{\Request::path()}}</span>
    </div>

    <script type="text/javascript" src="/js/HolidayRequestsHelper.js"></script>
    <script type="text/javascript" src="/js/holidayRequests.js?version={{Config::get('app.app_version')}}"></script>

    @if (isset($data['viewing_as_user']))
        <h1>Holiday Request Calendar For {{$data['viewable_user']->first_name . ' '.$data['viewable_user']->surname}}</h1>
    @else
        <h1>Your Requests</h1>
    @endif

    <div id="holidayBalanceContainer"></div>

    <div class="row">

        <div class="col-lg-6 col-md-6" id="holidayCalendarContainerParent">
            <p>Requesting a day of leave is easy. Please just click on a date to send a request to your manager</p>
            <ul>
                <li>Drag your mouse for multiple full days</li>
                <li>Click on a date for a single or half day</li>
                <li>Don't forget you can add holiday dates for the past too</li>
                <li><a href="{{action('\Powhr\Modules\HolidayRequests\Controllers\HolidayRequestController@getTeamView')}}" target="_blank">View Your Team Calendar</a> to see who has booked days off</li>
            </ul>
            <span id="token">{!! csrf_field() !!}</span>
            <div id="holidayCalendarContainer">
                @include('holidayCalendar')
            </div>

            <div class="clearfix"></div>

            <div class="holiday_request_key_container">
                <p class="holiday_request_key_label">Key:</p>
                <div class="holiday_request_key team_date_added team_date_awaiting_authorisation">Awaiting</div>
                <div class="holiday_request_key team_date_added team_date_authorised">Authorised</div>
                <div class="holiday_request_key team_date_added team_date_not_authorised">Not authorised</div>
                <div class="holiday_request_key team_date_added team_date_working_absence">Working Absence</div>
            </div>

        </div>

        <div class="col-lg-6 col-md-6" id="holidayCalendarFormContainer"></div>
        <div class="clearfix"></div>
    </div>
@stop
