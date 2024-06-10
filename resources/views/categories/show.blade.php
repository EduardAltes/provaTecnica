@extends('layouts.layout')

@include('partials.apart', ["site" => "categories"])

@section('content')
    <div class="container">
        <h1>Category Details</h1>
        <div class="card">
            <div class="card-header">
                <h2>{{ $category->name }}</h2>
            </div>
            <div class="card-body">
                <p>{{ $category->description }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                @if($category->father_id !== null)
                    <h2>Father ID</h2>
                    <p>{{ $category->father_id }}</p>
                @endif
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
