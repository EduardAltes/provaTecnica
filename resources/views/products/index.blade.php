@extends('layouts.layout')

@section('title', 'Products')

@include('partials.dataTable')

@section('content')
    <div class="container" style="margin-bottom: 30px">
        @if (session('success'))
            <div  class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary" style="margin-bottom: 30px">Create Product</a>
        <table id="table" class="table mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Categories</th>
                    <th>Num. photos</th>
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
                            @foreach($product->categories as $category)
                                <a href= " {{ route('categories.show', $category->id) }} " class="btn btn-outline-secondary btn-sm">{{ $category->name }}</a>
                            @endforeach
                        </td>
                        <td>
                            {{ $product->photos->count('photos') }}
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
