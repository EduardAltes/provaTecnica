@extends('layouts.layout')

@include('partials.apart', ["site" => "categories"])

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <h1>Edit Category</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $category->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="father_id">Father ID</label>
                <select name="father_id" id="father_id" class="form-control">
                    <option value="">None</option>
                    @foreach ($categories as $category_fe)
                        @if ($category->father_id == $category_fe->id)
                            @include('categories.partials.option', ['selected' => true, 'category_select' => $category_fe])
                        @else
                            @include('categories.partials.option', ['selected' => false, 'category_select' => $category_fe])
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
