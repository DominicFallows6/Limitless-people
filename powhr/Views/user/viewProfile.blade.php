@extends('layouts.base')

@section('body')

    <div class="account_form">

        <div class="row">

            <div class="container">

                <h2 class="user_profile_name">
                <a title="Send Email" href="mailto:{{$user->email}}"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                {!!$user->first_name. ' '.$user->surname!!}
                @if ($user->nickname != '')
                    <span class="profile_aka">...aka {!!$user->nickname!!}</span>
                @endif
                </h2>
                <p class="job_title">{!!$user->job_title!!}</p>
                <div class="row">

                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <div id="main_user_bio">
                            {!!$user->description!!}
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4" id="current_profile_avatar_edit">

                        <?php
                        if($user->profile_pic == '') {
                        ?>
                        <p>No Avatar added</p>
                        <?php
                        } else{
                        ?>
                        <img src="{!!$user->profile_pic!!}" />
                        <?php
                        }
                        ?>

                        <h3 style="margin: 15px 0 0 0">Works In:<br/>
                            {!!$user->organisationUnit->organisation_unit_name!!}</h3>

                        <p style="margin: 5px 0 10px 0">...Which is situated in...</p>
                        @foreach($user->organisationUnit->locations AS $loc_key=>$loc)
                            <h5>{!!$loc->building_name!!}</h5>
                        @endforeach
                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
