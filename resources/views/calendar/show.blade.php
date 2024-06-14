@extends('layouts.layout')

@include('partials.apart', ["site" => "calendar"])

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
        @if($event->products->isNotEmpty())
            <div class="card-body">
                <h2>Products</h2>
                @foreach($event->products as $product)
                    <h4 style="text-decoration: underline">Name</h4>
                    {{$product->name}}
                    <h4 style="text-decoration: underline">Units</h4>
                    {{$product->pivot->units}}
                    <h4 style="text-decoration: underline">Price</h4>
                    {{$product->prices->where('start_date', '<=', today())->where('end_date', '>=', today())->pluck('price')->first()===null ? 'No actual price' : ($product->prices->where('start_date', '<=', today())->where('end_date', '>=', today())->pluck('price')->first() * $product->pivot->units) . ' €'}}
                    <div style="margin: 30px 0;">------------------------</div>
                @endforeach
            </div>
        @endif
        <form action="{{ route('calendar.destroy', $event->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" style="margin-bottom: 30px">Delete</button>
        </form>
        {{-- <a href="{{ route('calendar.edit', $event->id) }}" class="btn btn-warning" style="margin-bottom: 30px">Edit</a> --}}
    </div>
@endsection
