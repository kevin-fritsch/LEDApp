<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoiceEventQueue extends Model
{

    protected $table = "voice_event_queues";

    protected $fillable = ['voiceevent_id', 'current'];

}
