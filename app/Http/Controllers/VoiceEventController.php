<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VoiceEvent;
use App\Event;

class VoiceEventController extends Controller
{
    public function index()
    {
        return view('voiceevent', ['voiceevents' => VoiceEvent::all()]);
    }

    public function create(Request $request)
    {
        $voiceevent = new VoiceEvent;

        $voiceevent->voiceCommand = $request->voiceCommand;

        $voiceevent->save();

        echo 1;
        var_dump($request->eventids);
        echo 3;

        foreach($request->eventids as $eventid) {

            $voiceevent->events()->attach($eventid);

            $voiceevent->save();

        }

        $voiceevent->save();

        return $this->index();
    }

    public function edit(Request $request)
    {
        $voiceevent = VoiceEvent::find($request->id);

        $voiceevent->voiceCommand = $request->voiceCommand;

        $voiceevent->save();

        return $this->index();
    }

    public function delete(Request $request)
    {
        $voiceevent = VoiceEvent::find($request->id);

        $voiceevent->delete();

        return $this->index();
    }

    public function getAll() {
        return response()->json(array('voiceevents' => VoiceEvent::all()), 200);
    }
}
