<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commercial extends Model
{
    public function advert(){
        return $this->belongsTo('App\Advert');
    }
    public function order(){
        return $this->belongsTo('App\Order');
    }
    public function agency(){
        return $this->belongsTo('App\Agency');
    }

    public function program(){
        return $this->belongsTo('App\Program');
    }
}
