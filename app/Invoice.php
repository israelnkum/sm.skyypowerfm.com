<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function radio_station(){
        return $this->belongsTo('App\RadioStation');
    }


    public function agency(){
        return $this->belongsTo('App\Agency');
    }
}
