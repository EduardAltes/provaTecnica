window.addEventListener('load', function() {
    // Get all delete buttons
    const deleteButtons = document.querySelectorAll('.delete-btn');

    // Add event listener to each button
    deleteButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
        // Get the first parent div of the button
        const parentDiv = event.target.closest('div');

        // Remove the parent div
        parentDiv.remove();
    });
    });

    // New delete buttons
    document.getElementById('addBtn').addEventListener('click', function() {
        var button = document.getElementById('addBtn');
        var div = document.createElement('div');

        div.innerHTML = `
            Start Date
            <input type="date" name="start_dates[]" class="form-control">
            End Date
            <input type="date" name="end_dates[]" class="form-control">
            Prices
            <input type="number" name="prices[]" class="form-control" step="0.01" min="0.00" max="999.99">
            <button type="button" class="btn btn-danger delete-btn" style="background-color: rgb(207, 52, 52); margin: 10px 0">Delete</button>
        `;

        var deleteBtn = div.querySelector('.delete-btn');
        deleteBtn.addEventListener('click', function() {
            div.remove();
        });
        
        button.parentNode.insertBefore(div, button);
    });
});
