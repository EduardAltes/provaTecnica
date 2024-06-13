@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Event Details</h1>
        <div class="card">
            <div class="card-header">
                <h2>{{ $event->id }}</h2>
            </div>
            <div class="card-body">
                <p>{{ $event->date }}</p>
            </div>
        </div>  
        <form action="{{ route('calendar.destroy', $event->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
