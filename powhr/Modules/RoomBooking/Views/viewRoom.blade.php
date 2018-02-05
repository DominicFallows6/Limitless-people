@extends('layouts.base')

@section('body')

    <div>
        <h1>Room booking</h1>
        <p>Hello This is my room booking page!</p>
        <hr>
    </div>

    <div class="change-Building">
        <a onclick="changeBuilding(this.id)" id="Prev"><-- Prev</a>
        <span id="room-name">L1</span>
        <a onclick="changeBuilding(this.id)" id="Next">Next --></a>
    </div>

    <div id="viewRoomLayout">
        @include('roomviews')
    </div>

        <div id="roomInformation">
            <label id="seatLabel">Number of seats:<span id="roomSeats"></span></label> <br>
            <label id="fullLabel">Room is full today:<span id="isFull"></span></label>
        </div>

@stop