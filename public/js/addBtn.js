window.addEventListener('load', function() {
    document.getElementById('addBtn').addEventListener('click', function() {
        var button = document.getElementById('addBtn');
        var div = document.createElement('div');

        div.innerHTML = `
            Start Date
            <input type="date" name="start_dates[]" class="form-control">
            End Date
            <input type="date" name="end_dates[]" class="form-control">
            Prices
            <input type="number" name="prices[]" class="form-control" step="0.01" min="0.00" max="99.99">
            <button class="btn btn-danger delete-btn" style="background-color: rgb(207, 52, 52); margin: 10px 0">Delete</button>
        `;

        var deleteBtn = div.querySelector('.delete-btn');
        deleteBtn.addEventListener('click', function() {
            div.remove();
        });
        
        button.parentNode.insertBefore(div, button);
    });
});
