@foreach($category->children as $child)
    <p>
    @for ($i = 0; $i < $tabs; $i++)
        &emsp;
    @endfor
    
    · {{ $child->name }}</p>
    @include('products.partials._p', ['category' => $child, "tabs" => $tabs + 1])
@endforeach
