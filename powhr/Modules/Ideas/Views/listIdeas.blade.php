@extends('layouts.base')

@section('body')

<script type="text/javascript">

    $(document).ready(function () {
        $('.alert-info').delay(10000).slideUp();
    })

    tinymce.init({
        selector: '#description'
    });

</script>

<div class="account_form">

    <div class="row">

        <div class="container">

            <h1>Ideas</h1>

            @if (Session::has('message'))
            <div class="alert alert-info">{{Session::get('message')}}</div>
            @endif

            <p>Got an idea? <a href="/ideas/edit/new">Add a new one here.</a></p>
            <hr />

            @foreach($ideas AS $key => $idea)
            <div class="idea_container row">
                <div class="col-lg-1 col-md-1 col-sm-1">
                    <img class="img_list ideas_list_image" src="<?php
                    if (file_exists(public_path($idea->user->profile_pic))) {
                        echo $idea->user->profile_pic;;
                    } ?>" />
                </div>
                <div class="col-lg-11 col-md-11 col-sm-11">
                    <div class="idea_name">
                        <a href="/ideas/idea/{{$idea->id}}">{{$idea->idea_name}}</a>
                    </div>
                    <div class="idea_description">
                        {{substr(strip_tags($idea->description, '<li>'), 0, 200)}}&hellip; by {{$idea->user->first_name. ' '.$idea->user->surname}}
                    </div>

                    @if($idea->idea_feedback != '')
                        <div>
                            Feedback: Added
                        </div>
                    @endif

                    <div>Comments: {{$idea->IdeasComments->count()}}</div>
                    <div>Likes: {{$idea->IdeasLikes->count()}}</div>
                    <div style="padding: 5px 10px; margin: 5px 0; background-color: #{{$idea->getStatus->idea_status_hex_color}}">Status: {{$idea->getStatus->idea_status_name}}</div>
                    <div>
                        <span class="comment_time"><i class="fa fa-clock-o" aria-hidden="true"></i> {!!date('dS F Y \a\t H:i',strtotime($idea->created_at))!!}</span>
                    </div>
                </div>


            </div>
            <hr />
            @endforeach

            <?php echo $ideas->render(); ?>

        </div>

    </div>

</div>

@stop
