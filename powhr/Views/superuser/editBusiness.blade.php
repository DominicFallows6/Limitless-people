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

            {!!Form::model($data['business'],[])!!}

            <div class="row">

                <div class="col-lg-12">

                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Public Information</a>
                        </li>
                        <li role="presentation">
                            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Modules</a>
                        </li>
                    </ul>

                    <div class="tab-content" style="padding: 10px 0 0 0;">
                        <div role="tabpanel" class="tab-pane active" id="home">

                            <div class="row">

                                <div class="col-lg-6">

                                    <h4>Public Information</h4>

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

                                </div>

                                {!!Form::close()!!}

                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">

                            <h4>Modules</h4>


                        </div>
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