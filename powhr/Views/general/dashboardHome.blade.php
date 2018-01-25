@extends('layouts.base')

@section('body')

<h1>Welcome to your dashboard</h1>

@if (Session::has('message'))
<div class="alert alert-info">{!!Session::get('message')!!}</div>
@endif

<div class="row">

    <div class="col-md-12 dashboard_announcements">

        <h3>Latest Announcements!</h3>

        @if($data['announcements'])
            @foreach($data['announcements'] AS $keyAnn => $valueAnn)
                <div class="business_announcement <?php echo $keyAnn % 2 == 0 ? 'even-announcement' : 'odd-announcement'?>">
                    <h5>{{$valueAnn->announcements_title}}</h5>
                    <p>{!!strip_tags($valueAnn->announcements_content,'<a><ul><li><p>')!!}</p>
                    <p class="business_announcement_datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> Added {{date('l dS F Y', strtotime($valueAnn->created_at))}}</p>
                </div>
            @endforeach
        @endif
    </div>

</div>


@stop
