<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript" src="/js/RoomBooking.js"></script>

<div id="BookingBlock">
        @foreach($rooms as $room)
            <div id="{{$room['id']}}">
                <h3>{{$room['room_name']}}</h3>
            </div>
        @endforeach
</div>