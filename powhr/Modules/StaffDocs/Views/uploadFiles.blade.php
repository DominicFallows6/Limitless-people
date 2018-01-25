@extends('layouts.admin')
@section('body')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Upload your files</h2>
                <p id="upload-instruction">Simply drag your files from your desktop or click inside the square to begin</p>
                @include('authenticated/uploader/uploaderbase')
            </div>
        </div>

        <div class="row">

        </div>

    </div>

@stop
