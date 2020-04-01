<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LED extends Model
{
    protected $table = "leds";

    protected $fillable = [
        "status", "gpio"
    ];

    public function events() 
    {
        return $this->hasMany('App\Event');
    }

}
