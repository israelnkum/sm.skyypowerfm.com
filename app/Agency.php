<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    public function radio_station(){
        return $this->belongsTo('App\RadioStation');
    }

    public function advert(){
        return $this->hasMany('App\Advert');
    }
}
