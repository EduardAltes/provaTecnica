@foreach($category->children as $child)
    @for ($i = 0; $i < $tabs; $i++)
        &emsp;
    @endfor
    <input type="checkbox" name="categories[]" id="{{ $child->id }}" value="{{ $child->id }}" data-ids="{{ $dataIds }}" @include('products.partials.condition', ["condition" => $condition])>
    {{ $child->name }}</br>
    @include('products.partials._form', ['category' => $child, "tabs" => $tabs + 1, "dataIds" => $dataIds . " " . $child->id, "condition" => $condition])
@endforeach
