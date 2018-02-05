<ul class="nav panel-list">

    <li class="parent_li">
        <a href="/dashboard">
            <i class="fa fa-tachometer" aria-hidden="true"></i>
            <span class="menu-text">Dashboard</span>
        </a>
    </li>

    @can('access_module', \Powhr\Modules\Ideas\Module::MODULE_ID)
    <li class="parent_li">
        <a href="/ideas">
            <i class="fa fa-bolt"></i>
            <span class="menu-text">Ideas</span>
        </a>
    </li>
    @endcan

        <li class="parent_li">
            <a href="/room-booking">
                <i class="fa fa-pencil-square-o"></i>
                <span class="menu-text">Room Booking</span>
            </a>
        </li>

    @can('access_module', \Powhr\Modules\HolidayRequests\Module::MODULE_ID)

        <li class="parent_li hoe-has-menu">
            <a href="javascript:void(0)">
                <i class="fa fa-calendar"></i>
                <span class="menu-text">Attendance</span>
                <span class="selected"></span>
            </a>
            <ul class="hoe-sub-menu" style="display: none;">
                <li>
                    <a href="{{action('\Powhr\Modules\HolidayRequests\Controllers\HolidayRequestController@getMyRequests')}}">
                        <span class="menu-text">My Requests</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li>
                    <a href="{{action('\Powhr\Modules\HolidayRequests\Controllers\HolidayRequestController@getTeamView')}}">
                        <span class="menu-text">Team Calendar</span>
                        <span class="selected"></span>
                    </a>
                </li>

                @if(\Auth::user()->isManagement())

                    <li>
                        <a href="{{action('\Powhr\Modules\HolidayRequests\Controllers\HolidayRequestController@getUserRequests')}}">
                            <span class="menu-text">Staff Requests</span>
                            <span class="selected"></span>
                        </a>
                    </li>

                @endif

            </ul>
        </li>


    @endcan

    @can('access_module', \Powhr\Modules\StaffDocs\Module::MODULE_ID)
        <li class="parent_li">
            <a href="/staff-docs">
                <i class="fa fa-download" aria-hidden="true"></i>
                <span class="menu-text">Business Documents</span>
            </a>
        </li>
    @endcan

    @if (\Session::get('is_admin', 0) > 0)
        <li class="parent_li">
            <a target = "_admintab" href="/admin_dashboard/home">
                <i class="fa fa-info" aria-hidden="true"></i>
                <span class="menu-text">Go To Admin</span>
            </a>
        </li>
    @endif
</ul>
