@extends('layouts.base')
@section('body')

    <h1>Update your Password</h1>

    <ul class="errors">
        @foreach($errors->all() as $message)
            <li>{!! $message !!}</li>
        @endforeach
    </ul>

    <div class="account_form" id="edit_profile_form">

        <div class="row">

            <div class="container">

                {!!\Form::open(
                array(
                    'url'=>URL::Full(),
                    'method'=>'post',
                ))!!}

                <div>
                    {!!Form::label('password', 'Password', array('id' => 'for_password')) !!}
                    {!!Form::password('password', null, array('id'=>'password'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::label('password_confirmation', 'Confirm Password', array('id' => 'for_password_confirmation')) !!}
                    {!!Form::password('password_confirmation', null, array('id'=>'password_confirmation'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::submit('Save', ['id'=>'Go', 'class'=>'btn btn-primary'])!!}
                </div>

                {!!\Form::close()!!}

            </div>

        </div>

@stop