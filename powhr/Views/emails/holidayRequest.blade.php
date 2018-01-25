@extends('emails.layouts.layout')

@section('body')

    <h1>Hi {{$bodyData['superior']->first_name}},</h1>
    <p><strong>{{$bodyData['hr_model']->first_name. ' '.$bodyData['hr_model']->surname}}</strong> has requested a {{$bodyData['hr_model']->holiday_request_type_name}} and it requires your attention &amp; approval.</p>

    <p><a href="{{action('\Powhr\Modules\HolidayRequests\Controllers\HolidayRequestController@getUserRequests')}}">For more information and to action, click here</a></p>

    <p>
        Thanks,<br />Limitless Notification Team
    </p>

@stop