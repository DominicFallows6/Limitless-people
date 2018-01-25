<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Limitless > People</title>

    @section('head')
        @include('global.html.public')
    @show
    
</head>
<body class="padded-head">

@include('global.html.header')

<div class="container">
    @yield('body')
</div>

@include('global.html.footer')

</body>
</html>