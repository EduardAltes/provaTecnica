@extends('layouts.layout')

@include('partials.apart', ["site" => "products"])

@section('css')
    <link href="{{ asset('css/inputFile.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ asset('js/script.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <h1>Edit Product</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="categories">Categories</label><br/>
                @foreach($categories as $category)
                    @if($category->father_id === null)
                        <input type="checkbox" name="categories[]" id="{{ $category->id }}" value="{{ $category->id }}" data-ids="0" {{ $product->categories()->where('id', $category->id)->exists()  ? 'checked' : '' }}>
                        {{ $category->name }}</br>
             
                        @foreach($category->children as $child)
                            &emsp;<input type="checkbox" name="categories[]" id="{{  $child->id }}" value="{{ $child->id }}" data-ids="{{ $category->id }}" @include('products.partials.condition', ["condition" => true])>
                            {{ $child->name }}</br>
                            @include('products.partials._form', ['category' => $child, "tabs" => 2, "dataIds" => $category->id . " " . $child->id, "product" => $product, "condition" => true])
                        @endforeach                      
                    @endif
                @endforeach
            </div>
            <div class="form-group">
                <label for="photos">Photos</label>
                <div>
                    @foreach ($product->photos as $photo)
                        <img src="data:image/jpeg;base64,{{ base64_encode($photo->photo) }}" alt="Photo" width="100">
                    @endforeach
                </div>
                <input type="checkbox" name="delete" value="true">
                Delete old photos
                <input type="file" name="photos[]" class="form-control" multiple>
            </div>
            <button type="submit" class="btn btn-primary" style="margin: 5px 0 30px 0">Update</button>
        </form>
    </div>
@endsection
