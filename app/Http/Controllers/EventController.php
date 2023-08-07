<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index($user_id)
    {
        $events = Event::where('user_id', $user_id)->get(['id', 'event', 'start_date', 'end_date', 'type']);
        return response()->json($events);
    }

    public function grid_calendar($user_id)
    {
        $events = Event::where('user_id', $user_id)->get(['id', 'event', 'start_date', 'end_date', 'type']);
        return response()->json($events);
    }
    public function edit($id)
    {
        // Assuming you have a method to fetch the event data by event_id from your database
        $event = Event::find($id);


        return response()->json($event);

        // Pass the event data to the view
    }
    public function saveEvent(Request $request, $user_id)
    {
        $request->validate([
            'event' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'selected_date' => 'required|date_format:Y-m-d',
            'event_type' => 'required', // Validate the selected_option

        ]);

        $event = new Event();
        $event->user_id = $user_id;
        $event->event = $request->input('event');
        $event->start_date = $request->input('selected_date') . ' ' . $request->input('start_time');
        $event->end_date = $request->input('selected_date') . ' ' . $request->input('end_time');
        $event->type = $request->input('event_type'); // Get the selected option value

        $event->save();


        return response()->json($event);
    }
    // EventController.php

public function deleteEvent($eventId)
{
    try {
        $event = Event::findOrFail($eventId);
        // Add additional checks here if needed, e.g., user ownership

        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error deleting event'], 500);
    }
}

public function update(Request $request)
{
    $event = Event::find($request->event_id);
    $validatedData = $request->validate([
        'event' => 'required|string',
        'start_date' => 'required',
        'end_date' => 'required',
        'adresse' => 'required|string',
        'notes' => 'required|string',
        'telephone' => 'required|numeric',
        'mobile' => 'required|numeric',
        'email' => 'required|email',
    ]);

    $event->event = $request->event;
    $event->start_date = $request->start_date;
    $event->end_date = $request->end_date;

    $event->adresse = $request->adresse;
    $event->notes = $request->notes;
    $event->telephone = $request->telephone;
    $event->mobile = $request->mobile;
    $event->email = $request->email;

    $event->save();
    return redirect()->back()->with('success', 'Cette intervention modifé avec success');


}


}
