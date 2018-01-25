@extends('layouts.superuser')

@section('body')

    <h1>List Modules</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Module ID</th>
            <th>Module Name</th>
            <th>Module Directory</th>
            <th>Module Base URL</th>
        </tr>
        </thead>
        <tbody>
        @if($data['modules_list'])
            @foreach($data['modules_list'] AS $key => $module)
                <tr>
                    <td>{{$module->id}}</td>
                    <td>{{$module->module_name}}</td>
                    <td>{{$module->module_directory}}</td>
                    <td>{{$module->module_base_url}}</td>
                    <td>Delete :: Edit</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@stop