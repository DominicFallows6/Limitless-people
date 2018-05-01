@extends('layouts.admin')

@section('body')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript" src="/js/RoomBooking.js"></script>

    <div>
        <h1>Room booking Admin</h1>
        <p>Hello This is my room booking page!</p>
        <hr>
    </div>

    <div id="navigation-buttons">
        <a class="btn-primary" href="/admin/RoomBooking/room-booking-admin/add-room">Add a room!</a>
        <a class="btn-primary" href="/admin/RoomBooking/room-booking-admin/delete-room">Delete/Edit a room!</a>
        <a class="btn-primary" href="/admin/RoomBooking/room-booking-admin/add-building">Add/Edit/Delete Building!</a>
    </div>

@stop