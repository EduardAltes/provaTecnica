@extends('layouts.layout')

@section('js')
    <script src="{{ asset('js/productsAddBtn.js') }}"></script>
@endsection

@include('partials.apart', ["site" => "products"])

@section('content')
    <div class="container">
        <h1>Create Event</h1>
        <form action="{{ route('calendar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Units</label>
                <input type="number" name="units" class="form-control" min=1 required>
            </div>
            <div class="form-group">
                <label for="products[]">Products</label>
                <select name="products[]" class="form-control">
                    <option value="">None</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} (ID: {{ $product->id }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button  type="button" id="addBtn" class="btn" style="background-color: rgb(62, 146, 100); margin: 10px 0; color: white">Add</button>
            </br><button type="submit" class="btn btn-primary" style="margin: 5px 0 30px 0">Save</button>
        </form>
    </div>
@endsection
