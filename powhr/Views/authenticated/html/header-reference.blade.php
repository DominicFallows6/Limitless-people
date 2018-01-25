<script type="text/javascript">
    $(document).ready(function(){
        //todo this will change once new grouped menus go in
        if ($('#management_menu li').length == 0) {
            $('#management_menu').hide();
        }
    });
</script>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/dashboard" title="Back To Dashboard" class="main-logo pull-left"><img src="/images/logo.png"></a>
        </div>
        @if(\Auth::check())
        <form id="search_container">
            <input name="search" id="search" value="Search For People" class="click_and_remember"/>
        </form>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                @can('access_module', \Powhr\Modules\Ideas\Module::MODULE_ID)
                    <li><a href="{{action('\Powhr\Modules\Ideas\Controllers\IdeasController@getIndex')}}"><i class="fa fa-bolt" aria-hidden="true"></i> Ideas</a></li>
                @endcan

                @can('access_module', \Powhr\Modules\HolidayRequests\Module::MODULE_ID)
                    <li><a href="{{action('\Powhr\Modules\HolidayRequests\Controllers\HolidayRequest@getMyHolidayRequests')}}"><i class="fa fa-calendar" aria-hidden="true"></i> Holiday Requests</a></li>
                @endcan

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/users/profile"><i class="fa fa-user" aria-hidden="true"></i> Edit Profile</a></li>
                        <li><a href="/users/profileimage"><i class="fa fa-picture-o" aria-hidden="true"></i> Update Avatar</a></li>
                        <li><a href="/users/view/{!!\Auth::user()->id!!}"><i class="fa fa-smile-o" aria-hidden="true"></i> View Profile</a></li>
                    </ul>
                </li>
                @if(\Auth::user()->isManagement())
                    <li class="dropdown" id="management_menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Management<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @can('access_module', \Powhr\Modules\HolidayRequests\Module::MODULE_ID)
                            <li>
                                <a href="{{action('\Powhr\Modules\HolidayRequests\Controllers\HolidayRequest@getUserHolidayRequests')}}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Staff Holiday Requests</a>
                            </li>
                            <li><a href="/holiday-requests/team-view"><i class="fa fa-calendar" aria-hidden="true"></i> Team View Calendar</a></li>
                            @endcan
                            @can('access_module', \Powhr\Modules\StaffDocs\Module::MODULE_ID)
                            <li><a href="/staff-docs"><i class="fa fa-download" aria-hidden="true"></i> Business Documents</a></li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if (\Session::get('is_admin', 0) > 0)
                            <li><a target = "_admintab" href="/admin_dashboard/home"><i class="fa fa-info" aria-hidden="true"></i> Go To Admin</a></li>
                        @endif
                        <li><a href="/account/logout"><i class="fa fa-eject" aria-hidden="true"></i> Logout</a></li>
                        <li><a href="{{action('\Powhr\Controllers\UserController@getChangePassword')}}"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
        @endif
    </div>
</nav>