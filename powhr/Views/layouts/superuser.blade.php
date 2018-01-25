<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{!!\Auth::user()->organisationUnit->business->business_name!!} Admin Area</title>

    @section('head')
        @include('global.html.public')
        <script type="text/javascript" src="/js/dashboard.js?version={{Config::get('app.app_version')}}"></script>
        <script type="text/javascript" src="/js/typeahead.bundle.js"></script>

        <link href="/jquery-ui-1.11.4/jquery-ui.min.css" rel="stylesheet">
        <script src="/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    @show

</head>
<body>


@include('superuser.html.header')

<div class="container">
    @yield('body')
</div>

@include('global.html.footer')

</body>
</html>
