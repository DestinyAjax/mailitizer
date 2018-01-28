<?php 
    $menu_id = (isset($menu_id)) ? $menu_id : "0.0";
    $menu_id = explode(".", $menu_id);
?>
<ul class="list-group">
    <li class="list-group-item {{menu_active($menu_id, 1)}}"><a href="{{ url('/') }}"><i class="fa fa-pencil"></i> Composer Message</a></li>
    <li class="list-group-item {{menu_active($menu_id, 2)}}"><a href="{{ url('/subscribers') }}"><i class="fa fa-users"></i> Subscribers</a></li>
    <li class="list-group-item {{menu_active($menu_id, 3)}}"><a href="{{ url('/lists') }}"><i class="fa fa-bars"></i> Lists</a></li>
    <li class="list-group-item {{menu_active($menu_id, 4)}}"><a href="{{ url('/templates') }}"><i class="fa fa-folder"></i> Templates</a></li>
    <li class="list-group-item {{menu_active($menu_id, 5)}}"><a href="{{ url('/profile') }}"><i class="fa fa-user"></i> My Profile</a></li>
    <li class="list-group-item {{menu_active($menu_id, 6)}}"><a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Settings</a></li>
</ul>
  