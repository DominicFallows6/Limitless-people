@extends('layouts.superuser')

@section('body')

    <h1>List Businesses</h1>
    <p><a href="/powhruser/add-business">Add a new business</a></p>

    <table class="table">
        <thead>
        <tr>
            <th>Business ID</th>
            <th>Business Name</th>
            <th>Logo</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($data['businesses'])
            @foreach($data['businesses'] AS $key => $business)
                <tr>
                    <td>{{$business->id}}</td>
                    <td>{{$business->business_name}}</td>
                    <td>{{$business->logo}}</td>
                    <td>Delete :: <a href="/powhruser/edit-business/<?=$business->id?>">Edit Business</a></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@stop