@extends('layouts.akachanHeader')

@include('layouts.leftsidemenu')

@include('layouts.leftSideUserBlock')

@section('internalCSSLibrary')
    @if (App::environment('production'))
    	{{ HTML::style('/css/fullcalendar.css', [], true) }}
    @else
    	{{ HTML::style('/css/fullcalendar.css') }}
    @endif
@stop

@section('internalJSLibrary')
    @if (App::environment('production'))
    	{{ HTML::script('/js/moment.min.js', [], true) }}
    	{{ HTML::script('/js/jquery-1.11.0.js', [], true) }}
        {{ HTML::script('/js/fullcalendar.js', [], true) }}
    @else
    	{{ HTML::script('/js/moment.min.js') }}
    	{{ HTML::script('/js/jquery-1.11.0.js') }}
        {{ HTML::script('/js/fullcalendar.js') }}
    @endif
@stop

@section('internalJSCode')
    <script type="text/javascript">
    jQuery(function($) {
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '{{ date("Y-m-d") }}',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: "/mycalendar/events",
			eventRender: function(event, element, view) {
			    if (event.allDay === 'true') {
					event.allDay = true;
			    } else {
					event.allDay = false;
			    }
			},
			selectable: true,
			selectHelper: true,
			select: function(start) {
				var d = new Date(start);
				location.href = "/mycalendar/add/event/" + d.getTime();
			}
		});
    });

    </script>
@stop

@section('content')
	<div id="page-wrapper">
		<br/>
		<div class="row rowContainer">
			<div class="col-lg-12">
				<div id='calendar'></div>
			</div>
		</div>
	</div>    
@stop