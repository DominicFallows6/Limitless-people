@extends('emails.layouts.layout')

@section('body')

    <h1>Hi {{$bodyData['superior']->first_name}},</h1>
    <p><strong>{{$bodyData['hr_model']->first_name. ' '.$bodyData['hr_model']->surname}}</strong> has added a date to their calendar.</p>

    <p>The request is a work based day of leave and doesn't need any further authorisation. This email is for information purposes only.</p>

    <p><a href="{{action('\Powhr\Modules\HolidayRequests\Controllers\HolidayRequestController@getUserRequests')}}">For more information and to action, click here</a></p>

    <p>
        Thanks,<br />Limitless Notification Team
    </p>

@stop