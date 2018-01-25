@extends('layouts.base')

@section('body')

    <h1>Team Calendar</h1>

    <div class="holiday_request_key_container">
        <p class="holiday_request_key_label">Key:</p>
        <div class="holiday_request_key team_date_added team_date_awaiting_authorisation">Awaiting</div>
        <div class="holiday_request_key team_date_added team_date_authorised">Authorised</div>
        <div class="holiday_request_key team_date_added team_date_not_authorised">Not authorised</div>
        <div class="holiday_request_key team_date_added team_date_working_absence">Working Absence</div>
    </div>

    @if (Session::has('message'))
        <div class="alert alert-info">{!!Session::get('message')!!}</div>
    @endif

    <div class="row">

        <div class="col-lg-12 col-md-12" id="team-data-parent">
            <span id="token">{!! csrf_field() !!}</span>
            <div id="teamCalendarContainer">
                @include('teamCalendarData')
            </div>
        </div>

    </div>
@stop
