<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/dashboard" class="main-logo pull-left"><img
                        src="/images/logos/{{\Auth::user()->organisationUnit->business->business_asset_name}}.png"/></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Site Data<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin_dashboard/businessinfo">Business Information</a></li>
                        <li><a href="/admin/business-announcements/business-announcements-admin">Business
                                Announcements</a></li>
                        <li><a href="/organisation_units_admin">Business Units</a></li>
                        <li><a href="/users_admin/">Users</a></li>
                        <li><a href="/admin/ideas/ideas-admin">Ideas</a></li>
                        <li><a href="/admin/staff-docs/staff-docs-admin/">Business Docs</a></li>
                        <li><a href="/admin/RoomBooking/room-booking-admin/">Room Booking</a></li>
                    </ul>
                </li>
                <li><a href="/account/logout">Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>