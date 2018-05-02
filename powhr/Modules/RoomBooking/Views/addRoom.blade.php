@extends('layouts.admin')

@section('body')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript" src="/js/RoomBooking.js"></script>

    <div>
        <h1>Room booking Admin</h1>
        <p>You can add a room from here!</p>
        <hr>
    </div>

    <form action="{{url('/room-booking-admin/add-room')}}" method="post">
        {{ csrf_field() }}
        <label for="room_name">Enter room name
            <input id="room_name" name="room_name" type="text"></label> <br>
        <label for="room_seats">Enter amount of seats
            <input id="room_seats" name="room_seats" type="text"></label> <br>
        <label for="room_building">Select building
                <select name="room_building">
                        @foreach($Buildings as $building)
                            <option value="{{$building['id']}}">{{$building['building_name']}}</option>
                        @endforeach
                </select></label>
            <input class="btn-primary" type="submit">
    </form>
    @if(isset($errors))
        @foreach($errors as $error)
            <p>{{$error}}</p>
        @endforeach
    @endif

    @if(isset($result))
        @if($result === true)
            <p>You have created a room!</p>
        @else
            <p>Room creation failed!</p>
        @endif
    @endif


@stop