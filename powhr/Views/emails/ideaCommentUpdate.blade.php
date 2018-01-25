@extends('emails.layouts.layout')

@section('body')

    <h1>Hi there!</h1>
    <p><strong>{{$request->user()->first_name. ' '.$request->user()->surname}}</strong> has commented on the idea "{{$idea->idea_name}}".</p>

    <p>For more information <a href="{{action('\Powhr\Modules\Ideas\Controllers\IdeasController@getIdea',['id'=>$idea->id])}}">click here</a></p>

    <p>
        Thanks,<br />Limitless Notification Team
    </p>

@stop