<table class="table_main">
    <thead>
    <tr id="table_first" class="first_last">
        <th class="first_last">Time:</th>
        @foreach($roomInformation as $info)
            <th data-room="{{$info['id']}}" >
                <a>{{$info['room_name']}}</a>
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    <?php $a = 0 ?>
    @foreach($times as $time)
        @if($a % 2 == 0)
            <tr class="even_row">
                <td class="time">{{$time}}</td>
                @foreach($roomInformation as $info)
                    <td class="new">
                        <div class="celldiv slots1"></div>
                    </td>
                @endforeach
            </tr>
        @else
            <tr class="odd_row">
                <td class="time" >{{$time}}</td>
                @foreach($roomInformation as $info)
                    <td class="new">
                        <div class="celldiv slots1"></div>
                    </td>
                @endforeach
            </tr>
        @endif
        <?php $a ++; ?>
    @endforeach
    </tbody>
</table>

