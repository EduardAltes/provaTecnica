@extends('layouts.layout')

@section('js')
<script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        editable: false,
        selectable: true,
        events: @json($events),
        dayMaxEventRows: true,
        views: {
            timeGrid: {
            dayMaxEventRows: 6 // adjust to 6 only for timeGridWeek/timeGridDay
            }
        },

        eventClick: function(info) {
            window.location.href = '/calendar/' + info.event.extendedProps.event.id;
        },

        dateClick: function(info) {
            console.log(info.dateStr);
            window.location.href = '/calendar/create/' + info.dateStr;
        },

      });
      
      calendar.render()
    })

</script>
@endsection

@section('content')
@if (session('success'))
<div  class="alert alert-success mt-2" style="width:40%; margin-left: auto; margin-right: auto;">
    {{ session('success') }}
</div>
@endif
<div class="container" style="margin-left: auto; margin-right: auto">
    <div class="col-md-12" style="margin-bottom: 45px">
        <a href="{{ route('calendar.create') }}" class="btn btn-primary" style="margin-left: 500px; margin-bottom: 30px">Create Event</a>
        <div class="card" style="width: 50%; margin: auto">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
                

</div>
@endsection
