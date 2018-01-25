<header id="hoe-header" hoe-lpanel-effect="shrink">
    <div class="hoe-left-header">
        <a href="/dashboard">
            <span>
                <img src="/images/logos/{{\Auth::user()->organisationUnit->business->business_asset_name}}.png" />
            </span>
        </a>
        <span class="icon-logo">
            <img src="/images/logos/{{\Auth::user()->organisationUnit->business->business_asset_name}}_icon.png" />
        </span>
        <span class="hoe-sidebar-toggle"><a href="#"></a></span>
    </div>
    <div class="hoe-right-header" hoe-position-type="relative" >
        <span class="hoe-sidebar-toggle"><a href="#"></a></span>
        <ul class="left-navbar">

            <li>
            <form method="post" class="hoe-searchbar">
                <input id="search" type="text" placeholder="Search..." name="keyword" class="form-control">
            </form>
            </li>
        </ul>
        <ul class="right-navbar">

            <li class="dropdown hoe-rheader-submenu hoe-header-profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span><img class="img-circle " src="{!!\Auth::user()->profile_pic!!}"></span>
                    <span>{!!\Auth::user()->first_name .' '.\Auth::user()->surname !!}  <i class=" fa fa-angle-down"></i></span>
                </a>
                <ul class="dropdown-menu ">
                    <li><a href="/users/profile"><i class="fa fa-user" aria-hidden="true"></i> Edit Profile</a></li>
                    <li><a href="/users/profileimage"><i class="fa fa-picture-o" aria-hidden="true"></i> Update Avatar</a></li>
                    <li><a href="/users/view/{!!\Auth::user()->id!!}"><i class="fa fa-smile-o" aria-hidden="true"></i> View Profile</a></li>
                    <li><a href="{{action('\Powhr\Controllers\UserController@getChangePassword')}}"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a></li>
                    <li><a href="/account/logout"><i class="fa fa-eject" aria-hidden="true"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>
