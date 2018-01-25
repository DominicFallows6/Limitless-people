@extends('layouts.public')

@section('body')

    <div class="container account_form">

        <h1>Please Register</h1>

        <ul class="errors">
            @foreach($errors->all() as $message)
                <li>{!! $message !!}</li>
            @endforeach
        </ul>

        {!!Form::open(
            array(
                'url'=>URL::Full(),
                'method'=>'post',
            )
        )!!}

        <div>
            {!!Form::label('first_name', 'First Name', array('id' => 'for_first_name')) !!}
            {!!Form::text('first_name', null, array('id'=>'first_name'))!!}
            <div class="clearfix"></div>
        </div>

        <div>
            {!!Form::label('surname', 'Surname', array('id' => 'for_surname')) !!}
            {!!Form::text('surname', null, array('id'=>'surname'))!!}
            <div class="clearfix"></div>
        </div>

        <div>
            {!!Form::label('email', 'Email', array('id' => 'for_email')) !!}
            {!!Form::text('email', null, array('id'=>'email'))!!}
            <div class="clearfix"></div>
        </div>

        <div>
            {!!Form::label('Department', 'Department', array('id' => 'for_organisation_unit_id')) !!}
            {!!Form::select('organisation_unit_id', $org_units, null, array('id'=>'organisation_unit_id'))!!}
            <div class="clearfix"></div>
        </div>

        <div>
            {!!Form::label('password', 'Password', array('id' => 'for_password')) !!}
            {!!Form::password('password', null, array('id'=>'password'))!!}
            <div class="clearfix"></div>
        </div>

        <div>
            {!!Form::submit('Register', ['id'=>'Go'])!!}
        </div>

    </div>

    {!!Form::close()!!}

@stop