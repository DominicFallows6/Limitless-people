@extends('layouts.admin')
@section('body')

    <h1>Idea List</h1>

    @if($data['ideas'])

        <table class="table">
            <thead>
            <tr>
                <th>Idea Name</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Created On</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data['ideas'] AS $key => $idea)

                <tr>
                    <td><a href="/admin/ideas/ideas-admin/edit/{{$idea->id}}">{{$idea->idea_name}}</a></td>
                    <td>{{$idea->getStatus->idea_status_name}}</td>
                    <td>{{$idea->user->first_name. ' '.$idea->user->surname}}</td>
                    <td>{!!date('dS F Y \a\t H:i',strtotime($idea->created_at))!!}</td>
                </tr>

            @endforeach

            </tbody>

        </table>

    @endif
@stop