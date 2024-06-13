window.addEventListener('load', function() {
    // New delete buttons
    document.getElementById('addBtn').addEventListener('click', function() {
        var button = document.getElementById('addBtn');
        var div = document.createElement('div');

        div.innerHTML = `
            <select name="products[]" class="form-control">
                    <option value="">None</option>
        @foreach ($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} (ID: {{ $product->id }})
                        </option>
                    @endforeach
            </select>
             <button type="button" class="btn btn-danger delete-btn" style="background-color: rgb(207, 52, 52); margin: 10px 0">Delete</button>
        `;

        var deleteBtn = div.querySelector('.delete-btn');
        deleteBtn.addEventListener('click', function() {
            div.remove();
        });
        
        button.parentNode.insertBefore(div, button);
    });
});
