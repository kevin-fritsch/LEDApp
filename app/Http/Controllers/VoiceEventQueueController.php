<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VoiceEventQueue;

class VoiceEventQueueController extends Controller
{

    function addToQueue(Request $request) {

        $queue = new VoiceEventQueue;

        $queue->voiceevent_id = $request->voiceevent_id;

        $queue->current = "warte";

        $queue->save();

    }

    function getAll() {
        return response()->json(array('voiceevents' => VoiceEventQueue::all()), 200);
    }

}
