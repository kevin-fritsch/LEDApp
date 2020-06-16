<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\LED;

class EventController extends Controller
{
    public function index()
    {

    }

    public function create(Request $request)
    {
        $event = new Event;

        $event->name = $request->eventName;
        $event->duration = $request->get("duration");
        $event->ledStatus = $request->ledStatus;

        $led = LED::find($request->led);

        $event->led()->associate($led);

        $event->save();

    }

    public function edit(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }

    public function getAll() {
        return response()->json(array('events' => Event::all()), 200);
    }
}
