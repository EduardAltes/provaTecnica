@extends('layouts.layout')

@include('partials.apart', ["site" => "categories"])

@section('content')
    <div class="container">
        <h1>Create Category</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="father_id">Father Name</label>
                <select name="father_id" id="father_id" class="form-control">
                    <option value="">None</option>
                    @foreach ($categories as $category)
                        @include('categories.partials.option', ['selected' => false, 'category_select' => $category])
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
