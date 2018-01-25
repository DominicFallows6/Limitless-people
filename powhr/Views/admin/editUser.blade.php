@extends('layouts.admin')

@section('body')

    <div class="account_form" id="edit_profile_form">

        <div class="container">

            <h2> {{!empty($data['user']->id) ? 'Update user profile \''.$data['user']->first_name . ' '.$data['user']->surname .'\'': 'Add New User'}}</h2>

            <div class="breadcrumb ideas_breadcrumb">
                <a href="{{action('\Powhr\Controllers\Admin\UserController@getIndex')}}">Back to users</a>
            </div>

            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Public Information</a>
                    </li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Personal
                            Information</a>
                    </li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Sensitive
                            Information</a>
                    </li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Job
                            Data</a>
                    </li>
                    <li role="presentation" class="dropdown">
                        <a href="#" class="dropdown-toggle" id="myTabDrop1" data-toggle="dropdown"
                           aria-controls="myTabDrop1-contents" aria-expanded="false">Uploads<span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                            <li class="">
                                <a href="#dropdown1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1" aria-expanded="false">Skills</a>
                            </li>
                            <li>
                                <a href="#dropdown2" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2" aria-expanded="false">Belbin Uploads</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content" style="padding: 10px 0 0 0;">
                    <div role="tabpanel" class="tab-pane active" id="home">

                        <div class="row">

                            <div class="col-lg-6">

                                <h4>Public Information</h4>

                                @if (Session::has('message'))
                                    <div class="alert alert-info">{!!Session::get('message')!!}</div>
                                @endif

                                <ul class="errors">
                                    @foreach($errors->all() as $message)
                                        <li>{!! $message !!}</li>
                                    @endforeach
                                </ul>

                                {!!Form::model($data['user'], array(
                                        'url'=>'/users_admin/edit-user/',
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
                                    {!!Form::label('bonus_days', 'Bonus Days', array('id' => 'for_bonus_days')) !!}
                                    {!!Form::text('bonus_days', null, array('id'=>'bonus_days'))!!}
                                    <div class="clearfix"></div>
                                </div>

                                <div>
                                    {!!Form::label('Job Title', 'Job Title', array('id' => 'for_job_title')) !!}
                                    {!!Form::text('job_title', null, array('id'=>'job_title'))!!}
                                    <div class="clearfix"></div>
                                </div>

                                <div>
                                    {!!Form::label('Department', 'Department', array('id' => 'for_organisation_unit_id')) !!}
                                    {!!Form::select('organisation_unit_id', $data['org_units'], $data['user']->organisation_unit_id, array('id'=>'organisation_unit_id'))!!}
                                    <div class="clearfix"></div>
                                </div>

                                <div>
                                    {!!Form::label('Superior', 'Direct Superior', array('id' => 'for_superior_id')) !!}
                                    {!!Form::select('superior_id', $data['other_users'], $data['user']->superior_id, array('id'=>'superior_id'))!!}
                                    <div class="clearfix"></div>
                                </div>

                                <?php
                                if (empty($data['user']->id)) {
                                ?>
                                <div>
                                    {!!Form::label('Password', 'Password', array('id' => 'for_password_id')) !!}
                                    {!!Form::text('password', null, array('id'=>'password', 'autocomplete'=>'off'))!!}
                                    <div class="clearfix"></div>
                                    <hr/>
                                    <p><span style="color: #ff0000;">For now, you will have to email the user with their password. This will be automated shortly...</span>
                                    </p>
                                </div>
                                <?php
                                }
                                ?>

                                <hr/>

                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <p><strong>A little about them:</strong></p>

                                    <div class="clearfix"></div>
                                    {!!Form::textarea('description', null, array('id'=>'description'))!!}
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div>
                                {!!Form::submit('Save This Panel', ['id'=>'Go', 'class'=>'btn btn-primary'])!!}
                            </div>

                            {!! Form::hidden('id', $data['user']->id) !!}

                            {!!Form::close()!!}

                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">

                        <h4>Personal Information</h4>
                        <p>Personal Information form can be added here</p>

                        <div>
                            {!!Form::submit('Save This New Panel', ['id'=>'Go', 'class'=>'btn btn-primary'])!!}
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">

                        <h4>Sensitive Information</h4>
                        <p>Sensitive Information form can be added here</p>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings">

                        <h4>Job Data Information</h4>
                        <p>Job data Information form can be added here</p>

                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="dropdown1" aria-labelledby="dropdown1-tab">
                        <h4>Skills Upload Form</h4>
                        <p>The skills upload form can added here</p>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="dropdown2" aria-labelledby="dropdown1-tab">
                        <h4>Belbin Upload Form</h4>
                        <p>The belbin upload form can be added here</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

@stop