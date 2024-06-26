@extends('layouts.layout')

@include('partials.apart', ["site" => "products"])

@section('content')
    <div class="container">
        <a href="{{ route('products.pdf', $product->id) }}" class="btn btn-primary" @if (isset($hideInPdf)) style="display: none;" @endif>Download PDF</a>
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
                                @if  ($product->categories()->where('id', $child->id)->exists())
                                    <p>&emsp;
                                    · {{ $child->name }}</p>
                                    @include('products.partials._p', ['category' => $child, "product" => $product, "tabs" => 2])
                                @endif
                            @endforeach                      
                        @endif
                    @endforeach
                </div>
            @endif
            
            @if($product->prices->isNotEmpty())
                <h2>Prices</h2>
                <div>
                    @foreach ($product->prices as $price)
                        <h4 style="text-decoration: underline">Start Date</h4>
                        <p>{{ $price->start_date }}</p>
                        <h4 style="text-decoration: underline">End Date</h4>
                        <p>{{ $price->end_date }}</p> 
                        <h4 style="text-decoration: underline">Price</h4>
                        <p>{{ $price->price }}</p>
                        <p>------------------------</p>
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
            <a href="{{ route('products.index') }}" class="btn btn-secondary" @if (isset($hideInPdf)) style="display: none;" @endif>Back</a>
        </div>  
    </div>
@endsection
