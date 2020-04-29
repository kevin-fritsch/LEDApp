<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function index()
    {
        
    }

    public function create(Request $request)
    {

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
