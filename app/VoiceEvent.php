<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoiceEvent extends Model
{
    protected $table = "voiceevents";

    protected $fillable = [
        "voiceCommand"
    ];

    public function events() 
    {
        return $this->belongsToMany('App\Event');
    }

}
