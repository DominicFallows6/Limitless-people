@extends('layouts.admin')

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


    <div>


        <div class="container">

            <h1>Edit an idea</h1>

            @if (Session::has('message'))
                <div class="alert alert-info">{!!Session::get('message')!!}</div>
            @endif

            <ul class="errors">
                @foreach($errors->all() as $message)
                    <li>{!! $message !!}</li>
                @endforeach
            </ul>

            {!!Form::model($data['idea'], array(
                'url'=>'/admin/ideas/ideas-admin/edit/',
                'method'=>'post',
            ))!!}

            <div class="form-group">

                <div class="row">

                    <div class="col-lg-6">

                        <div>
                            <p><strong>Idea Name</strong></p>
                            {!!Form::text('idea_name', null, array('id'=>'idea_name','class'=>'form-control'))!!}
                            <div class="clearfix"></div>
                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div>
                            <p><strong>Idea Status</strong></p>
                            {!! \Form::select('idea_status_id', $data['idea_statuses'], null, ['class'=>'form-control']) !!}
                            <div class="clearfix"></div>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">

                        <div>
                            <p><strong>Idea Feedback</strong></p>
                            {!!Form::textarea('idea_feedback', null, array('id'=>'idea_feedback', 'class'=>'form-control'))!!}
                            <div class="clearfix"></div>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">

                        <div>
                            {!!Form::textarea('description', null, array('id'=>'description'))!!}
                            <div class="clearfix"></div>
                        </div>

                    </div>

                </div>

                <div>
                    {!!Form::hidden('id') !!}
                    {!!Form::submit('Save', ['id'=>'Go', 'class'=>'btn btn-primary'])!!}
                </div>

                {!!Form::close()!!}

            </div>

        </div>


    </div>

@stop
