@extends('layouts.base')

@section('body')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            $('.alert-info').delay(10000).slideUp();

            $('#new_idea_comment').focus(function () {
                $(this).animate({
                    height: '100px'
                });
            });

            $('#new_idea_comment').blur(function () {
                $(this).animate({
                    height: '50px'
                });
            });

            $('#save_comment').click(function () {

                $('#new_comment_container').validate({
                    rules: {
                        new_idea_comment: {
                            required: true
                        }
                    },
                    messages: {
                        new_idea_comment: {
                            required: 'Please enter your comment'
                        }
                    }
                });

                if ($('#new_comment_container').valid()) {
                    $('#new_comment_container').submit();
                } else {
                    return false;
                }

            });

        });

        tinymce.init({
            selector: '#description'
        });

    </script>


    <div class="account_form">

        <div class="container">

            <div class="row">

                <div class="breadcrumb ideas_breadcrumb">
                    <a href="/ideas/">Back to ideas</a>
                </div>

                <h1>{{$viewData['idea']->idea_name}}</h1>
                <p>Created By <a href="/users/view/{{$viewData['idea']->user->id}} ">{{$viewData['idea']->user->first_name}} {{$viewData['idea']->user->surname}}</a>
                    <br /><span class="comment_time"><i class="fa fa-clock-o" aria-hidden="true"></i> {{date('dS F Y \a\t H:i',strtotime($viewData['idea']->created_at))}}</span></p>

                @if (Session::has('message'))
                    <div class="alert alert-info">{{Session::get('message')}}</div>
                @endif

                <ul class="errors">
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>

                <div class="idea_description_full">
                    {!! strip_tags(rtrim($viewData['idea']->description,'<p>&nbsp;</p>'."\n\r"), '<p>') !!}
                </div>

                @if($viewData['idea']->idea_feedback != '')
                    <div class="idea_feedback_box" style="border: 2px #{{$viewData['idea']->getStatus->idea_status_hex_color}} dashed;">
                        <h3>Feedback</h3>
                        {{$viewData['idea']->idea_feedback}}
                    </div>
                @endif

                <div style="padding: 5px 10px; margin: 5px 0; background-color: #{{$viewData['idea']->getStatus->idea_status_hex_color}}">
                    <strong>Status:</strong> <span>{{$viewData['idea']->getStatus->idea_status_name}}</span>
                </div>

                <div class="idea_likes">
                    <strong>Current Likes:</strong> {{$viewData['idea']->IdeasLikes->Count()}}
                    <?php
                    $currentUserLikes = array();
                    if ($viewData['idea']->IdeasLikes->Count() > 0) {
                    ?>
                    <div class="current_likes_idea">
                        <h4 class="current-likes">Current Likes</h4>
                        <?php
                        foreach ($viewData['idea']->IdeasLikes AS $keyLikes => $valLikes) {
                            $currentUserLikes[] = $valLikes->users_id;
                            echo '<a href="/users/view/' . $valLikes->user->id . '" class="btn btn-default btn-sm current_like_idea">' . $valLikes->user->first_name . ' ' . $valLikes->user->surname . '</a>';
                        }
                        ?>
                    </div>
                    <?php
                    }
                    //stop user 'Liking' multiple times
                    if (!in_array(\Auth::user()->id, $currentUserLikes)) {
                    ?>
                    <div>
                        <a title="Click To Like" class="btn btn-primary btn-sm add_like_button"
                           href="/ideas/addlike/{{$viewData['idea']->id}}"><i class="fa fa-thumbs-o-up"></i></a>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div>
                        <a class="btn btn-primary btn-sm add_like_button"
                           href="/ideas/removelike/{{$viewData['idea']->id}}">Remove Like</a>
                    </div>
                    <?php
                    }

                    ?>
                </div>

                <div class="idea_comments">
                <h3>Comments</h3>

                    {!! Form::open(array('url' => '/ideas/addcomment', 'id'=>'new_comment_container')) !!}
                    <textarea id="new_idea_comment" name="new_idea_comment"></textarea>
                    <a href="javascript:;" id="save_comment" class="btn btn-primary">Save</a>
                    <input type="hidden" name="idea_id" value="{{$viewData['idea']->id}}">
                    {!! Form::close() !!}

                    @foreach($viewData['comments'] AS $com_key => $com_val)

                        <?php
                            $url = '/users/view/'.$com_val->user->id;
                        ?>

                        <div class="idea_comment_container">
                            <div class="col-lg-1">

                                <?php
                                if (file_exists(public_path($com_val->user->profile_pic))) {
                                    $profilePic = $com_val->user->profile_pic;
                                }
                                ?>

                                <a href="{{$url}}"><img class="img_list ideas_list_image" src="{{$profilePic}}" /></a>

                            </div>
                            <div class="col-lg-11">
                                <h4><a href="{{$url}}">{{$com_val->user->first_name . ' '. $com_val->user->surname}}</a> said:</h4>
                                <div class="idea_comment">
                                    {{strip_tags($com_val->idea_comment)}}
                                    <br/>
                                    <span class="comment_time"><i class="fa fa-clock-o" aria-hidden="true"></i> {{date('dS F Y \a\t H:i',strtotime($com_val->created_at))}}</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>

@stop
