<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function fetchEvents()
    {
        if (auth()->id() == 1) { // Si el usuario es administrador (ID 1)
            $events = Event::all();
        } else { // Si es un usuario normal
            $events = Event::where('user_id', auth()->id())->get();
        }

        return response()->json($events);
    }


    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return response()->json($event);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}
