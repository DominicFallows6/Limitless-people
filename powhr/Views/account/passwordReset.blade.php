@extends('layouts.public')

@section('body')

    <div class="container account_form">

        <div class="row">

            <h1>Reset Your Password</h1>

            <form method="POST" action="/password/reset">

                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">

                @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div>
                    {!!Form::label('email', 'Email', array('id' => 'for_email')) !!}
                    <input type="email" name="email" value="{{ old('email') }}">
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::label('password', 'Password', array('id' => 'for_password')) !!}
                    <input type="password" name="password">
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::label('confirm_password', 'Confirm Password', array('id' => 'for_password_confirmation')) !!}
                    <input type="password" name="password_confirmation">
                    <div class="clearfix"></div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">
                        Reset Password
                    </button>
                </div>

            </form>

        </div>

    </div>

@stop

