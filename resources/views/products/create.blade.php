@extends('layouts.layout')

@section('css')
    <link href="{{ asset('css/inputFile.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/addBtn.js') }}"></script>
@endsection

@include('partials.apart', ["site" => "products"])

@section('content')
    <div class="container">
        <h1>Create Product</h1>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="categories">Categories</label><br/>
                @foreach($categories as $category)
                    @if($category->father_id === null)
                        <input type="checkbox" name="categories[]" id="{{ $category->id }}" value="{{ $category->id }}" data-ids="0">
                        {{ $category->name }}</br>
             
                        @foreach($category->children as $child)
                            &emsp;<input type="checkbox" name="categories[]" id="{{  $child->id }}" value="{{ $child->id }}" data-ids="{{ $category->id }}">
                            {{ $child->name }}</br>
                            @include('products.partials._form', ['category' => $child, "tabs" => 2, "dataIds" => $category->id . " " . $child->id, "condition" => false])
                        @endforeach                      
                    @endif
                @endforeach
            </div>
            <div id="prices" class="form-group">
                <label for="prices">Prices</label></br>
                
                <button  type="button" id="addBtn" class="btn" style="background-color: rgb(62, 146, 100); margin: 10px 0; color: white">Add</button>
            </div>
            <div class="form-group">
                <label for="photos">Photos</label>
                <input type="file" name="photos[]" class="form-control" multiple>
            </div>
            <button type="submit" class="btn btn-primary" style="margin: 5px 0 30px 0">Save</button>
        </form>
    </div>
@endsection
