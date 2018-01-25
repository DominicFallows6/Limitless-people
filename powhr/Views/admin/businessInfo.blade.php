@extends('layouts.admin')

@section('body')

    <div class="account_form">

        <div class="row">

            <div class="container">

                <h1>Business Information</h1>

                @if (Session::has('message'))
                    <div class="alert alert-info">{!!Session::get('message')!!}</div>
                @endif

                <ul class="errors">
                    @foreach($errors->all() as $message)
                        <li>{!! $message !!}</li>
                    @endforeach
                </ul>

                {!!Form::model($data['business'], array(
                    'method'=>'post',
                ))!!}

                <div>
                    {!!Form::label('business_name', 'Business Name', array('id' => 'for_business_name')) !!}
                    {!!Form::text('business_name', null, array('id'=>'business_name'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::label('default_days_leave', 'Default Days Leave', array('id' => 'for_default_days_leave')) !!}
                    {!!Form::text('default_days_leave', null, array('id'=>'default_days_leave'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::submit('Save', ['id'=>'Go', 'class'=>'btn btn-primary'])!!}
                </div>

                {!!Form::close()!!}

            </div>

        </div>

    </div>

@stop
