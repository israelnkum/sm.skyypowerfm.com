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

    protected $fillable = [
        'name','address','location','phone_number','fax','ad_prefix','signature','logo','user_id'
    ];
}
