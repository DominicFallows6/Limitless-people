@extends('layouts.public')

@section('body')

    <div class="container account_form">

        <div class="row">

            <div class="">

                <h1>Please Login</h1>

                @if (\Session::has('message'))
                    <div class="alert alert-info">{!!\Session::get('message')!!}</div>
                @endif

                <ul class="errors">
                    @foreach($errors->all() as $message)
                        <li>{!! $message !!}</li>
                    @endforeach
                </ul>

                {!!Form::open(
                    array(
                        'url'=>'/account/login',
                        'method'=>'post',
                    )
                )!!}

                <div>
                    {!!Form::label('email', 'Email', array('id' => 'for_email')) !!}
                    {!!Form::text('email', null, array('id'=>'email'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::label('password', 'Password', array('id' => 'for_password')) !!}
                    {!!Form::password('password', null, array('id'=>'password'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::submit('Login', ['id'=>'Go'])!!}
                    <div class="clearfix"></div>
                </div>

                {!!Form::close()!!}

                <p class="not_registered"><a href="/password/email">Forgot Password?</a></p>

            </div>

        </div>

    </div>

@stop