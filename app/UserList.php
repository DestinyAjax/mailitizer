<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    public function fnSubscribers() {
        return $this->hasMany('App\Subscriber','user_list_id');
    }
}
