<div class="panel panel-default panel-flush">
    <div class='panel-heading'>
        Your Menu
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item active"><a href="{{ url('/') }}"><i class="fa fa-pencil"></i> Composer Message</a></li>
            <!-- <li class="list-group-item"><a href=""><i class="fa fa-send"></i> Sent</a></li>
            <li class="list-group-item"><a href=""><i class="fa fa-book"></i> Draft</a></li> -->
            <li class="list-group-item"><a href="{{ url('/subscribers') }}"><i class="fa fa-users"></i> Subscribers</a></li>
            <!-- <li class="list-group-item"><a href=""><i class="fa fa-folder"></i> Templates</a></li> -->
            <li class="list-group-item"><a href=""><i class="fa fa-user"></i> My Profile</a></li>
            <li class="list-group-item"><a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Settings</a></li>
        </ul>
    </div>
</div>