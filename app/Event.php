<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";

    protected $fillable = [
        "duration", "ledStatus"
    ];

    public function voiceEvent()
    {
        return $this->belongsTo('App\VoiceEvent');
    }

    public function led()
    {
        return $this->belongsTo('App\LED');
    }

}
