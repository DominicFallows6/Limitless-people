@extends('layouts.base')
@section('body')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('.alert-info').delay(10000).slideUp();
        })

        tinymce.init({
            selector: '#description'
        });
        
    </script>

    <div class="account_form" id="edit_profile_form">

        <div class="row">

            <div class="container">

                <h1>Update your profile</h1>

                @if (Session::has('message'))
                    <div class="alert alert-info">{!!Session::get('message')!!}</div>
                @endif

                <ul class="errors">
                    @foreach($errors->all() as $message)
                        <li>{!! $message !!}</li>
                    @endforeach
                </ul>

                {!!Form::model($user, array(
                        'url'=>'/users/saveprofile',
                        'method'=>'post',
                 ))!!}

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
                    {!!Form::label('nickname', 'Nickname', array('id' => 'for_nickname')) !!}
                    {!!Form::text('nickname', null, array('id'=>'nickname'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::label('Job Title', 'Job Title', array('id' => 'for_job_title')) !!}
                    {!!Form::text('job_title', null, array('id'=>'job_title'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::label('Department', 'Department', array('id' => 'for_organisation_unit_id')) !!}
                    {!!Form::select('organisation_unit_id', $org_units, $user->organisation_unit_id, array('id'=>'organisation_unit_id'))!!}
                    <div class="clearfix"></div>
                </div>

                <hr/>

                <div>
                    <p><strong>A little about yourself:</strong></p>

                    <div class="clearfix"></div>
                    {!!Form::textarea('description', null, array('id'=>'description'))!!}
                </div>

                <div>
                    {!!Form::submit('Save', ['id'=>'Go', 'class'=>'btn btn-primary'])!!}
                </div>

                {!!Form::close()!!}

            </div>

        </div>

    </div>

@stop
