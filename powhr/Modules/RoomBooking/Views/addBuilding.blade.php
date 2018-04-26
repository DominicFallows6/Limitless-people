@extends('layouts.admin')

@section('body')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript" src="/js/RoomBooking.js"></script>

    <div>
        <h1>Room booking Admin</h1>
        <p>You can add a building from here!</p>
        <hr>
    </div>


    <form action="{{url('/room-booking-admin/add-building')}}" method="post">
        {{ csrf_field() }}
        <label for="building_Name" >Enter building name
            <input id="building_Name" name="building_name" type="text"></label> <br>
        <input class="btn-primary" type="submit">
    </form>
    @if(isset($errors))
        @foreach($errors as $error)
            <p>{{$error}}</p>
        @endforeach
    @endif

    @if(isset($result))
        @if($result === true)
            <p>You have created a building!</p>
        @else
            <p>Building creation failed!</p>
        @endif
    @endif


@stop