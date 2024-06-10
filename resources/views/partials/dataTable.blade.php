@section('css')
<link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap.css" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('js')
<script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap.js"></script>
<script defer> 
    window.onload= (function() {
        $('#table').DataTable();
    });
</script>
@endsection