@extends('layouts.admin')

@section('body')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript" src="/js/RoomBooking.js"></script>

    <meta name='csrf-token' content='{{csrf_token()}}'>

    <div>
        <h1>Room booking Admin</h1>
        <p>You can delete or edit a room from here!</p>
        <hr>
    </div>


    @foreach($rooms as $room)
        <div class="allRoomsInAdmin" id="allRoomsAdmin">
            <div id="editor{{$room['id']}}"></div>
            <a class="btn-primary" onclick="deleteRoom(this.id)" id="{{$room['id']}}">Delete</a>
            <a class="btn-primary" onclick="editRoom(this.id)" id="{{$room['id']}}">Edit</a>
            <p id="edit_room_name" >Room Name: {{$room['room_name']}}</p>
            <p id="edit_building_id" >Building id: {{$room['building_id']}}</p>
            <p id="edit_room_seats" >Room seats: {{$room['room_seats']}}</p>
        <hr>
        </div>
    @endforeach

@stop
