@extends('layouts.admin')

@section('body')

    <h1>Business Units</h1>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Unit Location Name</th>
            <th>View</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($data['organisationUnits']) {
        foreach($data['organisationUnits'] AS $key => $value) {
        ?>
        <tr>
            <td>{!!$key+1!!}</td>
            <td>{!!$value->organisation_unit_name!!}</td>
            <td>{!!$value->organisation_unit_slug!!}</td>
            <td>Edit :: Delete</td>
        </tr>
        <?php
        }
        }
        ?>
        </tbody>
    </table>
@stop