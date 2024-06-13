@section('css')
<link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('js')
<script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script defer src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>

<!-- Include DataTables Buttons extension and dependencies -->
<script defer src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script defer src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script defer src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script defer> 
    window.onload = function() {     
        $('#table').DataTable({
            dom: '<"top-section"lfB>rt<"bottom-section"ip>',

            buttons: [
                {
                    extend: 'excelHtml5',

                    exportOptions: {
                        stripHtml: true,
                        columns: ':not(.no-export, .no-excel)',
                        search: 'applied',
                        order: 'applied',
                        customizeData: function(data) {
                            // Find the index of the 'categories' column
                            var categoryIndex = data.header.indexOf('Categories');
                            if (categoryIndex !== -1) {
                                // Iterate through each row in the data
                                data.body.forEach(function(row) {
                                    // Replace spaces with "|" only in the 'categories' column
                                    row[categoryIndex] = row[categoryIndex].replace(/\s+/g, " | ");
                                });
                            }
                        }
                    },
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'portrait',
                    
                    customize: function(doc) {
                        // Find paths of all images, already in base64 format
                        var arr2 = $('img').map(function(){
                            return this.src;
                        }).get();

                        var imageIndex = 0;

                        // Iterate through the table body rows
                        for (var i = 0; i < doc.content[1].table.body.length; i++) {
                            for (var j = 0; j < doc.content[1].table.body[i].length; j++) {
                                var cell = doc.content[1].table.body[i][j];

                                if (cell.text) {
                                    // Split the cell text by 'photo' to handle multiple occurrences
                                    var parts = cell.text.split('photo');
                                    var newContent = [];

                                    parts.forEach((part, index) => {
                                        newContent.push({ text: part });
                                        if (index < parts.length - 1 && imageIndex < arr2.length) {
                                            newContent.push({ image: arr2[imageIndex], width: 20 });
                                            imageIndex++;
                                        }
                                    });

                                    // Flatten newContent array if it contains multiple parts
                                    if (newContent.length > 1) {
                                        cell.stack = newContent;
                                        delete cell.text; // Remove the original text key to avoid conflicts
                                    }
                                }
                            }
                        }
                    },

                    exportOptions: {
                        stripHtml: true,
                        columns: ':not(.no-export)',
                        search: 'applied',
                        order: 'applied',

                        customizeData: function(data) {
                            // Find the index of the 'categories' column
                            var categoryIndex = data.header.indexOf('Categories');
                            if (categoryIndex !== -1) {
                                // Iterate through each row in the data
                                data.body.forEach(function(row) {
                                    // Replace spaces with "|" only in the 'categories' column
                                    row[categoryIndex] = row[categoryIndex].replace(/\s+/g, " | ");
                                });
                            }
                        },
                    }
                }
            ]
        });
    }
</script>
@endsection
