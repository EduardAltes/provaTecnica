@extends('layouts.layout')

@section('title', 'Menu')

@section('content')
    <div class="container">
        <div class=""><a href= {{  url('/categories') }}>CATEGORIES</a></div>
        <div><a href= {{ url('/products')}}>PRODUCTS</a></div>
    </div>
@endsection