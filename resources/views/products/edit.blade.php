@extends('layouts.layout')

@include('partials.apart', ["site" => "products"])

@section('css')
    <link href="{{ asset('css/inputFile.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/addBtn.js') }}"></script>
@endsection

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
            <div id="prices" class="form-group">
                <label for="prices">Prices</label></br>
                
                @foreach ($product->prices as $price)
                    <div>
                        Start Date
                        <input type="date" name="start_dates[]" class="form-control" value="{{ $price->start_date }}">
                        End Date
                        <input type="date" name="end_dates[]" class="form-control" value="{{ $price->end_date }}">
                        Prices
                        <input type="number" name="prices[]" class="form-control" step="0.01" min="0.00" max="999.99" value="{{ $price->price }}">
                        <button type="button" class="btn btn-danger delete-btn" style="background-color: rgb(207, 52, 52); margin: 10px 0">Delete</button>
                    </div>
                @endforeach
                
                <button type="button" id="addBtn" class="btn" style="background-color: rgb(62, 146, 100); margin: 10px 0; color: white">Add</button>
            </div>
            <div class="form-group">
                <label for="photos">Photos</label>
                <div>
                    @foreach ($product->photos as $photo)
                        <div>
                            <img src="data:image/jpeg;base64,{{ base64_encode($photo->photo) }}" alt="Photo" width="100" style="margin:10px 0">
                            <input type="hidden" name="photos64[]" value="{{ base64_encode($photo->photo) }}">
                            <button type="button" class="btn btn-danger delete-btn" style="background-color: rgb(207, 52, 52); margin: 10px">Delete</button>
                        </div>
                    @endforeach
                    {{-- <input type="checkbox" name="delete" value="true">
                    Delete old photos --}}
                    <input type="file" name="photos[]" class="form-control" multiple>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="margin: 5px 0 30px 0">Update</button>
        </form>
    </div>
@endsection
