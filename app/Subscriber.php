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
}
