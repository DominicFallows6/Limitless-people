<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/powhruser/" class="main-logo pull-left">Powhr</a>
        </div>
        @if(\Auth::check())
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Site Data<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/powhruser/list-businesses">List Businesses</a></li>
                            <li><a href="/powhruser/list-modules">List Modules</a></li>
                        </ul>
                    </li>
                    <li><a href="/account/logout">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        @endif
    </div>
</nav>