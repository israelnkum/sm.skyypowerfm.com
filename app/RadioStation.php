<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadioStation extends Model
{
    public function user(){
        return $this->hasMany('App\User');
    }

    public function agency(){
        return $this->hasMany('App\Agency');
    }
}
