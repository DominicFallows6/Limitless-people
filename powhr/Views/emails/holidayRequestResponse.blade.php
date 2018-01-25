@extends('emails.layouts.layout')

@section('body')

    <h1>Hi {{$bodyData['hr_model']->user->first_name}},</h1>
    <p>One of your requests has been actioned!</p>

    <p><a href="{{action('\Powhr\Modules\HolidayRequests\Controllers\HolidayRequestController@getMyRequests')}}">For more information, click here</a></p>

    <p>
        Thanks,<br />Limitless Notification Team
    </p>

@stop