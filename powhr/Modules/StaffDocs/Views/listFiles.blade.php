@extends('layouts.base')

@section('body')

    <div class="container">

        <h1>Documents available to download</h1>

        @if (Session::has('message'))
            <div class="alert alert-info">{!!Session::get('message')!!}</div>
        @endif

        <div class="row">

            <div class="col-lg-12">

                @if($data['staff_docs'])

                    @foreach($data['staff_docs'] AS $key => $value)

                        <?php
                        /** @var \Powhr\ViewHelpers\IconMaps $iconHelper */
                        ?>

                        <div class="col-lg-3 col-md-3 uploaded-file-list">
                            <p>
                                {{$value->original_name}}
                                <br/>
                                Size: {{number_format($value->asset_size / 1024 / 1024, 4)}} MBs
                                <br/>
                                <?php echo $iconHelper->getIconReference($value->extension) ?> {{$value->extension}}
                                <br/>
                                <a href="/staff-docs/download-file/{{$value->id}}">Download</a>
                            </p>
                        </div>

                    @endforeach

                 @else

                    <p>Documents will appear here when available</p>

                @endif


            </div>
        </div>

    </div>
@stop
