<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LED;

class LEDController extends Controller
{
    public function index()
    {
        return view('led', ['leds' => LED::all()]);
    }

    public function create(Request $request)
    {
        $led = new LED;

        $led->status = false;
        $led->gpio = $request->gpio;

        $led->save();

        return $this->index();
    }

    public function edit(Request $request)
    {
        $led = LED::find($request->id);

        $led->gpio = $request->gpio;

        $led->save();

        return $this->index();
    }

    public function delete(Request $request)
    {
        $led = LED::find($request->id);
        $led->delete();
    }
}
