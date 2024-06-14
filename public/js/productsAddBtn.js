window.addEventListener('load', function() {
    // New delete buttons
    document.getElementById('addBtn').addEventListener('click', function() {
        // Get the select container
        var selectContainer = document.getElementById('select-container');
        
        // Create a new wrapper div for the cloned select and delete button
        var wrapper = document.createElement('div');
        wrapper.className = 'select-wrapper mb-3';
        
        // Clone the original select element
        var originalSelect = document.querySelector('#select-container div');
        var clonedSelect = originalSelect.cloneNode(true);
        
        // Create the delete button
        var deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'btn btn-danger delete-btn';
        deleteBtn.style = 'background-color: rgb(207, 52, 52); margin: 10px 0';
        deleteBtn.textContent = 'Delete';
        
        // Delete the input value
        clonedSelect.querySelector('input').value = '';

        // Append the cloned select and delete button to the wrapper
        wrapper.appendChild(clonedSelect);
        wrapper.appendChild(deleteBtn);
        
        // Append the wrapper to the select container
        selectContainer.appendChild(wrapper);
        
        // Add event listener to the delete button
        deleteBtn.addEventListener('click', function() {
            wrapper.remove();
        });
    });
});
