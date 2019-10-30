<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransmissionCertificate extends Model
{
    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function advert(){
        return $this->belongsTo('App\Advert');
    }
}
