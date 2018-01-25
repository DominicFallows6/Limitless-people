@extends('layouts.base')

@section('body')

    <h1>Your Staff Requests</h1>
    <span id="token">{!! csrf_field() !!}</span>


    {!! \Form::open([
        'method'=>'get'
    ]) !!}

    <div class="row" style="margin-bottom: 10px;">

        <div class="col-md-2">
            <p>Year Balance</p>
            {!!\Form::Select('year', $data['calendar_years'], \Request::input('year', date('Y')))!!}
        </div>

        <div class="col-md-2">
            <p>Please choose your list</p>
            {!!\Form::Select('direct_report', $data['user_scope'], \Request::input('direct_report'))!!}
        </div>

        <div class="col-md-2">
            <p>&nbsp;</p>
            {!!\Form::submit('Go') !!}
        </div>

    </div>


    {!!Form::close() !!}

    <table class="table">
        <thead>
        <tr>
            <th>Calendar</th>
            <th>Name</th>
            <th>Email</th>
            <th>Business Unit</th>
            <th class="text-center">Leave Remaining</th>
            <th class="text-center"><span title="Requests Pending">Requests Pending</span></th>
        </tr>
        </thead>
        <tbody>
        @if($data['userList'])
            @foreach($data['userList'] AS $key => $user)
                <tr>
                    <td><a href="/attendance/my-requests/act_as/{!!$user->id!!}">View and edit</a></td>
                    <td>{!!$user->first_name!!} {!!$user->surname!!}</td>
                    <td><a href="mailto:{!!$user->email!!}">{!!$user->email!!}</a></td>
                    <td>{!!$user->organisation_unit_name!!}</td>
                    <td class="text-center">{!!$user->balance!!}</td>
                    <td class="text-center"><a href="javascript:;"
                                               data-username="{!!$user->first_name!!} {!!$user->surname!!}"
                                               data-toggle="modal" data-target="#powhrModal"
                                               data-userid="{{$user->id}}">{{$user->hr_group_awaiting}}</a></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    <script type="text/javascript"
            src="/js/ManagementHolidayRequests.js?version={{Config::get('app.app_version')}}"></script>

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
