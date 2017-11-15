<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ config('constants.WEB_URL') }}" target="_blank"> <img src="{{ asset('images/logo.png') }}" alt="logo" class="img-responsive"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-user"></i> {{ auth()->user()->name }}</a></li>
                <li><a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Settings</span></a></li>
                <li ><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</span></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

