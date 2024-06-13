@extends('layouts.layout')

@section('title', 'categories')

@include('partials.dataTable', ["showButtons" => false])

@section('content')
    <div class="container" style="margin-bottom: 30px">
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <h1>Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary" style="margin-bottom: 30px">Create Category</a>
        <table id="table" class="table mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Father ID</th>
                    <th class="no-export">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->father_id }}</td>
                        <td class="no-export">
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
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
