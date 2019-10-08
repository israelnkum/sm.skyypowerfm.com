<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    public function radio_station(){
        return $this->belongsTo('App\RadioStation');
    }
    public function agency(){
        return $this->belongsTo('App\Agency');
    }
    public function order(){
        return $this->hasMany('App\Order');
    }
    protected $fillable = [
        'agency_id','radio_station_id','advert_number','name','audio_file','user_id'
    ];
}
