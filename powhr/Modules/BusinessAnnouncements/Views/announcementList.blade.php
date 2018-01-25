@extends('layouts.admin')
@section('body')

    <h1>Business Announcements</h1>

    <p><a href="/admin/business-announcements/business-announcements-admin/edit/">Create New</a></p>

    @if($data['announcements'])

        <table class="table">
            <thead>
            <tr>
                <th>Announcement Title</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data['announcements'] AS $key => $announcement)

                <tr>
                    <td>{{$announcement->announcements_title}}</td>
                    <td>{{$announcement->first_name .' '.$announcement->surname}}</td>
                    <td>{{$announcement->created_at}}</td>
                    <td><a href="/admin/business-announcements/business-announcements-admin/edit/{{$announcement->id}}">Edit</a></td>
                </tr>

            @endforeach

            </tbody>

        </table>

    @endif
@stop