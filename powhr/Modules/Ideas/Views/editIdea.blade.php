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


    <div class="account_form">

        <div class="row">

            <div class="container">

                <h1>Add an idea</h1>

                @if (Session::has('message'))
                    <div class="alert alert-info">{!!Session::get('message')!!}</div>
                @endif

                <ul class="errors">
                    @foreach($errors->all() as $message)
                        <li>{!! $message !!}</li>
                    @endforeach
                </ul>

                {!!Form::model($idea, array(
                    'url'=>'/ideas/edit',
                    'method'=>'post',
                ))!!}

                <div>
                    <p><strong>Your Idea Name</strong></p>
                    {!!Form::text('idea_name', null, array('id'=>'idea_name'))!!}
                    <div class="clearfix"></div>
                </div>

                <div>
                    {!!Form::textarea('description', null, array('id'=>'description'))!!}
                    <div class="clearfix"></div>
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
