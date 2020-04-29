<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";

    protected $fillable = [
        "name", "duration", "ledStatus"
    ];

    public function voiceEvents()
    {
        return $this->belongsToMany('App\VoiceEvent');
    }

    public function led()
    {
        return $this->belongsTo('App\LED');
    }

}
