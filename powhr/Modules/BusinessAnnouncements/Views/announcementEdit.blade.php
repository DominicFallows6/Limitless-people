@extends('layouts.admin')

@section('body')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script type="text/javascript">

        tinymce.init({
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            selector: '#announcements_content',
            image_advtab: true
        });

    </script>

    <div class="account_form" id="edit_profile_form">

        <div class="row">

            <h2>Your Announcment</h2>

            <ul class="errors">
                @foreach($errors->all() as $message)
                    <li>{!! $message !!}</li>
                @endforeach
            </ul>

            <div class="breadcrumb ideas_breadcrumb">
                <a href="/admin/business-announcements/business-announcements-admin">Back to Announcements</a>
            </div>

            <div class="container">

                {!! \Form::model($data['announcement'])!!}

                <div>
                    {!!Form::label('announcements_title', 'Title', array('id' => 'for_announcements_title')) !!}
                    {!!Form::text('announcements_title', null, array('id'=>'announcements_title'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::textarea('announcements_content', null, array('id'=>'announcements_content'))!!}
                </div>

                <div>
                    {!!Form::submit('Save', ['id'=>'Go', 'class'=>'btn btn-primary'])!!}
                </div>

                {!! Form::hidden('id', $data['announcement']->id) !!}

                {!! \Form::close() !!}

            </div>

        </div>

    </div>

@stop
