@extends('layouts.base')

@section('body')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript" src="/js/Tables.js"></script>
    <meta name='csrf-token' content='{{csrf_token()}}'>

    <h1>Room booking</h1>
    <p>You can book a room from here.</p>
    <label for="buildings">Choose a building
        <select id="buildings">
            {{--<option disabled >Please choose a room</option>--}}
            @if(isset($Buildings))
                {!! $Buildings !!}
            @endif
        </select>
    </label>
    <div id="container">
    @if(isset($Data))
        @if($Data == 'no')
            <h5>Sorry, No rooms added to this building yet!</h5>
        @else
            {!! $Data !!}
    </div>
            <a href="{{action('\Powhr\Modules\RoomBooking\Controllers\RoomBookingController@getCreateRoomBookingTable') }}?view-month=<?php echo date("m"); ?>&area=1">View
                month</a>
            <a href="{{action('\Powhr\Modules\RoomBooking\Controllers\RoomBookingController@getCreateRoomBookingTable') }}?view-week=<?php echo date("w"); ?>&area=2">View
                week</a>
            <a href="{{action('\Powhr\Modules\RoomBooking\Controllers\RoomBookingController@getCreateRoomBookingTable') }}?view-day=<?php echo date("d"); ?>&area=1">View
                day</a>
        @endif
    @else
    @endif
    <div class="modal fade" id="powhrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel"></h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop