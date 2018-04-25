@extends('layouts.base')

@section('body')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript" src="/js/Tables.js"></script>


    <h1>Room booking</h1>
    <p>You can book a room from here.</p>

    @if(isset($Data))
        @if($Data == null)
            <p>Sorry, No table</p>
        @else
            {!! $Data !!}
        @endif
        @else
    @endif

    <a href="{{action('\Powhr\Modules\RoomBooking\Controllers\RoomBookingController@getCreateRoomBookingTable') }}?view-month=<?php echo date("m"); ?>&area=1">View month</a>
    <a href="{{action('\Powhr\Modules\RoomBooking\Controllers\RoomBookingController@getCreateRoomBookingTable') }}?view-week=<?php echo date("w"); ?>&area=2">View week</a>
    <a href="{{action('\Powhr\Modules\RoomBooking\Controllers\RoomBookingController@getCreateRoomBookingTable') }}?view-day=<?php echo date("d"); ?>&area=1">View day</a>
@stop