<table class="table">
    <thead>
    <tr>
        <th>Date Start</th>
        <th>Date End</th>
        <th class="">Type</th>
        <th class="text-center">Duration</th>
        <th class="text-center">Day Count</th>
        <th class="text-center">Authorise</th>
        <th class="text-center">Decline</th>
    </tr>
    </thead>
    <tbody>
    @if($data['holidayRequests'])
        @foreach($data['holidayRequests'] AS $key => $hrRequest)
            <tr>
                <td>{{date('l jS F Y',strtotime($hrRequest->start))}}</td>
                <td>{{date('l jS F Y',strtotime($hrRequest->end))}}</td>
                <td class="">
                    <?php echo ($hrRequest->holiday_request_type_name); ?>
                </td>
                <td class="text-center">
                    <?php echo ($hrRequest->duration_type == 1.00 ? 'Full' : 'Half'); ?>
                </td>
                <td class="text-center">
                    <?php echo ($hrRequest->duration_type == 1.00 ? $hrRequest->day_count : '-'); ?>
                </td>
                <td class="text-center response-cell">
                	<a class="leaveResponse" href="javascript:;" data-responsetype="1" data-requestid="{{$hrRequest->id}}" title="Click To Authorise"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                </td>
                <td class="text-center response-cell">
                	<a class="leaveResponse" href="javascript:;" data-responsetype="0" data-requestid="{{$hrRequest->id}}" title="Click To Decline"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>