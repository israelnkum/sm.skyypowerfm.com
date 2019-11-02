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

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function invoice(){
        return $this->hasMany('App\Invoice');
    }

    protected $fillable = [
        'radio_station_id','agency_name','address','fax','email','phone_number','discount','contact_person','user_id'
    ];
}
