<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Limitless > People</title>

    @section('head')

        @include('global.html.public')

        <script type="text/javascript" src="/js/dashboard.js?version={{Config::get('app.app_version')}}"></script>
        <script type="text/javascript" src="/js/typeahead.bundle.js"></script>

        <link href="/jquery-ui-1.11.4/jquery-ui.min.css" rel="stylesheet">
        <script src="/jquery-ui-1.11.4/jquery-ui.min.js"></script>
        <link href="/css/hoe.css?version={{Config::get('app.app_version')}}" rel="stylesheet"/>
        <link href="/css/assets/{{Config::get('app.app_name')}}.css?version={{Config::get('app.app_version')}}" rel="stylesheet"/>

        <script src="/js/hoe.js?version={{Config::get('app.app_version')}}"></script>

        @if ($business_assets)
            @foreach($business_assets AS $keyAsset => $valueAsset)
                @if($valueAsset->asset_type == 'css')
                    <link href="{{$valueAsset->asset_path}}"/>
                @elseif($valueAsset->asset_type == 'js')
                    <script type="text/javascript" src="{{$valueAsset->asset_path}}"></script>
                @endif
            @endforeach
        @endif

    @show

</head>


<?php
/*<body>
@include('authenticated.html.sidebar')

<div class="container">
    @yield('body')
</div>



@include('global.html.footer')

<script type="text/javascript">
var people = <?php
require(storage_path().'/cache/'.\Auth::user()->organisationUnit->business->unique_id.'.json');
?>
</script>

</body>
*/
?>

<body hoe-navigation-type="vertical" hoe-nav-placement="left" theme-layout="wide-layout" theme-bg="bg1">

<div id="hoeapp-wrapper" class="hoe-hide-lpanel" hoe-device-type="desktop">
    <header id="hoe-header" hoe-lpanel-effect="shrink">
        @include('authenticated.html.header')
    </header>

    <div id="hoeapp-container" hoe-color-type="lpanel-bg2" hoe-lpanel-effect="shrink">
        <aside id="hoe-left-panel" hoe-position-type="absolute">
            @include('authenticated.html.sidebar')
        </aside>
        <section id="main-content">
            <div class="inner-content">
                @yield('body')
            </div>
        </section>
    </div>
</div>

</body>

<script type="text/javascript">
    var people = <?php
    require(storage_path() . '/cache/' . \Auth::user()->organisationUnit->business->unique_id . '.json');
    ?>
</script>

</html>