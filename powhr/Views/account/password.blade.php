@extends('layouts.public')

@section('body')

    <div class="container account_form">

        <div class="row">

            <h1>Reset your Password</h1>

            <form method="POST" action="/password/email">

                {!! csrf_field() !!}

                @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div>
                    {!!Form::label('email', 'Email', array('id' => 'for_email')) !!}
                    {!!Form::text('email', null, array('id'=>'email'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">
                        Send Password Reset Link
                    </button>
                </div>

            </form>

        </div>

    </div>

@stop