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

    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function programs(){
        return $this->hasMany('App\Program');
    }

    public function invoice(){
        return $this->hasMany('App\Program');
    }

    protected $fillable = [
        'name','address','location','phone_number','fax','ad_prefix','signature','logo','user_id'
    ];
}
