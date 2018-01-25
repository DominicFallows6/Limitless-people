@extends('layouts.admin')

@section('body')

    <h1>User List</h1>

    @if (Session::has('message'))
        <div class="alert alert-info">{!!Session::get('message')!!}</div>
    @endif

    <a href="{{action('\Powhr\Controllers\Admin\UserController@getEditUser')}}">Add New User</a>

    <table class="table">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Business Unit</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($data['userList'])
            @foreach($data['userList'] AS $key => $user)
                <tr>
                    <td><a href="/users/view/{!!$user->id!!}">{!!$user->id!!}</a></td>
                    <td>{!!$user->first_name!!} {!!$user->surname!!}</td>
                    <td><a href="mailto:{!!$user->email!!}">{!!$user->email!!}</a></td>
                    <td>{!!$user->organisation_unit_name!!}</td>
                    <td><a href="{{action('\Powhr\Controllers\Admin\UserController@getDeleteUser', ['id'=>$user->id])}}">Delete</a> :: <a href="{{action('\Powhr\Controllers\Admin\UserController@getLoginAsUser', ['id'=>$user->id])}}">Login As User</a> :: <a href="{{action('\Powhr\Controllers\Admin\UserController@getEditUser', ['id'=>$user->id])}}">Edit</a></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop