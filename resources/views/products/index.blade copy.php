@extends('layouts.layout')

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('title', 'Products')

@section('content')
    <div class="container">
        @if (session('success'))
            <div  class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Categories</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            @php    
                                $product_id = $product->id;
                                $productsHaveCategories_array = json_decode($productsHaveCategories);
                                $productsHaveCategories_filtered = array_filter($productsHaveCategories_array, function($product_filtered) use ($product_id) {
                                    return $product_filtered->product_id == $product_id;
                                });
                            @endphp

                            @foreach ($productsHaveCategories_filtered as $productHasCategory)
                                @php    
                                    $category_id = $productHasCategory->category_id;
                                    $categories_array = json_decode($categories);
                                    $categories_filtered = array_filter($categories_array, function($category_filtered) use ($category_id) {
                                        return $category_filtered->id == $category_id;
                                    });
                                @endphp
                                
                                @foreach ($categories_filtered as $category)
                                    <a href= " {{ route('categories.show', $category->id) }} " class="btn btn-outline-secondary btn-sm">{{ $category->name }}</a>
                                @endforeach
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
