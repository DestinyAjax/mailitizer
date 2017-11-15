<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    public static function hasEmail($value){
        $check = self::where('email','=',$value)->first();
        if($check){
            return true;
        }
        return false;
    }

    public function UserList(){
        return $this->belongsTo('App\UserList','user_list_id','id');
    }
}
