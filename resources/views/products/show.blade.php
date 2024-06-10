@extends('layouts.layout')

@include('partials.apart', ["site" => "products"])

@section('content')
    <div class="container">
        <h1>Product Details</h1>
        <div class="card">
            <div class="card-header">
                <h2>{{ $product->name }}</h2>
            </div>
            <div class="card-body">
                <p>{{ $product->description }}</p>
            </div>

            @if($product->categories->isNotEmpty())
                <div class="card-body">
                    <h2>Categories</h2>
                    @foreach($product->categories as $category)
                        @if($category->father_id === null)
                            <p>
                            · {{ $category->name }}</p>
                    
                            @foreach($category->children as $child)
                                <p>&emsp;
                                · {{ $child->name }}</p>
                                @include('products.partials._p', ['category' => $child, "tabs" => 2])
                            @endforeach                      
                        @endif
                    @endforeach
                </div>
            @endif

            @if($product->photos->isNotEmpty())
                <h2>Photos</h2>
                <div>
                    @foreach ($product->photos as $photo)
                        <img src="data:image/jpeg;base64,{{ base64_encode($photo->photo) }}" alt="Photo" width="100">
                    @endforeach
                </div>
            @endif
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </div>  
    </div>
@endsection
