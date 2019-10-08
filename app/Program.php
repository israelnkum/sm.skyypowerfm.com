<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable =[
        'program_name','radio_station_id','day','start_time','end_time','duration','presenter','user_id'
    ];

    public function radio_station(){
        return $this->belongsTo('App\RadioStation');
    }
}
