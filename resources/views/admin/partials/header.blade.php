<header>
    <div class="container">  
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-4 pull-right">
                <div id="top-nav" align="right">
                    <ul class="nav">
                        <li class="" ><a title="" href="#"><i class="fa fa-user"></i> <span class="text">{{ auth()->user()->name }}</span></a></li>
                        <li class=""><a title="" href="#"><i class="fa fa-cog"></i> <span class="text">Settings</span></a></li>
                        <li class=""><a title="" href="{{ url('/logout') }}"><i class="fa fa-share-alt"></i> <span class="text">Logout</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

