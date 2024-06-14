<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Product;

class CalendarController
{

    public function index()
    {   
        $all_events = Event::all();
        $events = [];

        foreach ($all_events as $event) {
            $events[] = [
                'title' => 'Buy list on date (' . $event->date . ')',
                'start' => $event->date,
                'end' => $event->date,
                'extendedProps' => [
                    'event' => $event,
                ]
            ];
        }
        return view('calendar.index', compact('events', 'all_events'));
    }

    public function show($id) {
        
        $event = Event::all()->find($id);
        return view('calendar.show', compact('event'));
    }


    public function create()
    {   
        $products = Product::all();

        return view('calendar.create', compact('products'));
    }

    public function store(Request $request)
    {   
        
        $request->validate([
            'date' => 'date',
            'units' => 'array',
            'units.*' => 'integer|min:1',
            'products' => 'array',
            'products.*' => 'integer|exists:products,id',
        ]);
            
        $event = Event::create($request->all());

        $products = $request->input('products');
        $units = $request->input('units');

        if($request->has('products') && $request->has('units')) {
            foreach ($products as $key => $product) {
                $event->products()->attach($product, ['units' => $units[$key]]);
            }
        }

        return redirect()->route('calendar.index')
            ->with('success', 'Event created successfully.');
    }

    public function destroy($id)
    {   
        $event = Event::all()->find($id)->delete();

        return redirect()->route('calendar.index')
            ->with('success', 'Event deleted successfully.');
    }
}


