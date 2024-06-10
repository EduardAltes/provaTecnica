window.addEventListener('load', function() {
    var checkboxesAll = document.querySelectorAll('input[type="checkbox"]');

    checkboxesAll.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Check if the checkbox is checked
            if (checkbox.checked && checkbox.getAttribute('data-ids') != 0) {
                var dataIds = checkbox.getAttribute('data-ids');

                var ids = dataIds.split(' ');

                ids.forEach(id => {
                    document.getElementById(id).checked = true;
                });
            } else {
                var id = checkbox.id;
                
                var elements = Array.from(document.querySelectorAll('input[data-ids]')).filter(function(el) {
                    return el.getAttribute('data-ids').split(' ').includes(id) && el.checked;
                });
                
                if(elements.length > 0) {
                    checkbox.checked = true;
                }

            }
        });
    });
});