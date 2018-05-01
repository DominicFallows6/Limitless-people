@extends('layouts.admin')

@section('body')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript" src="/js/RoomBooking.js"></script>

    <meta name='csrf-token' content='{{csrf_token()}}'>

    <div>
        <h1>Room booking Admin</h1>
        <p>You can add/edit or delete a building from here!</p>
        <hr>
    </div>


    <form action="{{url('/room-booking-admin/add-building')}}" method="post">
        {{ csrf_field() }}
        <h3>Add building</h3>
        <label for="building_Name">Enter building name
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
    <hr>
    <h3>All buildings currently in Limitless digitall</h3>
    <hr>
<div id="buildings">
    @foreach($buildingNames as $building)

        <div id="buildingDiv">
            <a class="btn-primary" onclick="deleteBuilding(this.id)" id="{{$building['id']}}">Delete</a>
            <a class="btn-primary" onclick="editBuilding(this.id, '{{$building['building_name']}}')" id="{{$building['id']}}">Edit</a>
            <p id="building_Name">Name: {!! $building['building_name'] !!}</p>
            <br><hr>
        </div>

    @endforeach
</div>


@stop