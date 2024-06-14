<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Event;

class CalendarAPIController
{
    public function index()
    {
        $all_events = Event::all();
        $events = [];

        foreach ($all_events as $event) {
            $events[] = $event;
        }

        return response()->json($events);
    }

    public function show($id)
    {
        $event = Event::all()->find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        return response()->json($event);
    }


    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'units' => 'array',
            'units.*' => 'integer|min:1',
            'products' => 'array',
            'products.*' => 'integer|exists:products,id',
        ]);

        $event = Event::create($request->all());

        $products = $request->input('products');
        $units = $request->input('units');

        if ($request->has('products') && $request->has('units')) {
            foreach ($products as $key => $product) {
                $event->products()->attach($product, ['units' => $units[$key]]);
            }
        }

        dd($units);

        return response()->json(['message' => 'Event created successfully.'], 201);
    }

    public function destroy($id)
    {
        $event = Event::all()->find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted successfully.']);
    }
}