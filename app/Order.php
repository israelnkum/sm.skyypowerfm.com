<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function radio_station(){
        return $this->belongsTo('App\RadioStation');
    }
    public function agency(){
        return $this->belongsTo('App\Agency');
    }

    public function advert(){
        return $this->belongsTo('App\Advert');
    }

    protected $fillable= [
        'order_number','agency_id','advert_id','received_date','start_date','end_date','user_id'
    ];
}
