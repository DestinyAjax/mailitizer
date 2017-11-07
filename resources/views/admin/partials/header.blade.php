<!-- <header>
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div id="top-nav">
                <ul class="nav">
                    <li class="" ><a title="" href="#"><i class="fa fa-user"></i> <span class="text">{{ auth()->user()->name }}</span></a></li>
                    <li class=""><a title="" href="#"><i class="fa fa-cog"></i> <span class="text">Settings</span></a></li>
                    <li class=""><a title="" href="{{ url('/logout') }}"><i class="fa fa-share-alt"></i> <span class="text">Logout</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</header> -->
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
            <a class="navbar-brand" href="#"> <img src="{{ asset('images/22-1.png') }}" height="30" width="150"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-user"></i> {{ auth()->user()->name }}</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</span></a></li>
                <li ><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</span></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

