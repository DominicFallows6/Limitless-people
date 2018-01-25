@extends('layouts.base')
@section('body')

<h1>Update your Avatar Image</h1>

@if (Session::has('message'))
    <div class="alert alert-info">{!!Session::get('message')!!}</div>
@endif

<div class="row">

    <div class="col-lg-8">
        {!! Form::open(array('url'=>'users/profileimage','files'=>true)) !!}

        <h3>Add a New Image</h3>

        <ul class="errors">
            @foreach($errors->all() as $message)
                <li>{!! $message !!}</li>
            @endforeach
        </ul>

        {!! Form::label('file','Select an image using the form below',array('id'=>'','class'=>'')) !!}
        {!! Form::file('file','',array('id'=>'','class'=>'btn')) !!}
        {!! Form::submit('Save', array('id'=>'save_avatar','class'=>'btn btn-primary'))!!}
        {!! Form::close() !!}
    </div>

    <div class="col-lg-4" id="current_profile_avatar_edit">
        <h3>Current Image</h3>
        <?php
        if(\Auth::user()->profile_pic == '') {
            ?>
            <p>No Avatar added</p>
            <?php
        } else{
            ?>
            <img src="{!!\Auth::user()->profile_pic!!}" />
            <?php
        }
        ?>
    </div>

</div>

@stop