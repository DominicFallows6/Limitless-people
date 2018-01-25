@extends('layouts.superuser')

@section('body')

    <h1>Add Business</h1>

    <ul class="errors">
        @foreach($errors->all() as $message)
            <li>{!! $message !!}</li>
        @endforeach
    </ul>

    <div class="account_form" id="edit_profile_form">

        <div class="container">

            {!!Form::open()!!}

            <div class="row">

                <div class="col-lg-12">

                    <p>Please add the business here. Once we have the initial data, you can edit it later</p>

                    <div>
                        <p><strong>Enter Business Name</strong></p>
                        {!!Form::text('business_name', null, array('id'=>'business_name'))!!}
                        <div class="clearfix"></div>
                    </div>

                    <div>
                        <p><strong>Enter Default Days Leave for the business</strong></p>
                        {!!Form::text('default_days_leave', null, array('id'=>'default_days_leave'))!!}
                        <div class="clearfix"></div>
                    </div>

                    <div>
                        <p>
                            <strong>Enter Business Units</strong> - enter using comma separated values like so:
                        </p>
                        <p>
                            Human Resources, Information Technology, Customer Services
                        </p>
                        {!!Form::textarea('business_units', null, array('id'=>'business_units'))!!}
                        <div class="clearfix"></div>
                    </div>

                    <div>
                        <p>
                            <strong>Enter Business Locations</strong> - enter using comma separated values like so:
                        </p>
                        <p>
                            Building 1, Building 2, Warehouse
                        </p>
                        {!!Form::textarea('unit_locations', null, array('id'=>'unit_locations'))!!}
                        <div class="clearfix"></div>
                    </div>

                    <div>
                        {!!Form::submit('Save', ['id'=>'Go', 'class'=>'btn btn-primary'])!!}
                    </div>

                </div>

            </div>

            {!!Form::close()!!}

        </div>

    </div>

@stop