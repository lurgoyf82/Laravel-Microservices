<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(Event::all());
    }

    public function store(Request $request)
    {
        $event = Event::create($request->only(['event_name','user_id','properties']));
        return response()->json($event, 201);
    }

    public function show(Event $event)
    {
        return response()->json($event);
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->only(['event_name','user_id','properties']));
        return response()->json($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->noContent();
    }
}
