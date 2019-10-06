<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = "taxes";
    protected $fillable = [
        'name','value','user_id'
    ];
}
