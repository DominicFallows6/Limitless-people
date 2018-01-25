@extends('layouts.base')

@section('body')

    <h1>Sites Organisation Units and Locations</h1>

    @foreach($organisationUnits AS $org_key=>$org_unit)
        <a href="/organisation_units/unit/{!!($org_unit->organisation_unit_slug)!!}">{!!$org_unit->organisation_unit_name!!}</a> - {!!$org_unit->business->group_name!!}<br />
        @if(!$org_unit->locations->isEmpty())
            @foreach($org_unit->locations AS $l_key => $l_value)
                &nbsp;&nbsp;<a href="/unit_locations/location/{!!$l_value->unit_location_slug!!}">{!!$l_value->building_name!!}</a>
                <br />
            @endforeach
        @else
            No Locations Found<br />
        @endif
    @endforeach
@stop