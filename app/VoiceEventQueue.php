<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoiceEventQueue extends Model
{
    
    protected $fillable = ['voiceevent_id', 'current'];

}
