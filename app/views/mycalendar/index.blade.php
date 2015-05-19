@extends('layouts.akachanHeader')

@include('layouts.leftsidemenu')

@include('layouts.leftSideUserBlock')

@section('internalCSSLibrary')
    @if (App::environment('production'))
    	{{ HTML::style('/css/fullcalendar.css', [], true) }}
    @else
    	{{ HTML::style('/css/fullcalendar.css') }}
    	{{ HTML::style('/css/fullcalendar.print.css'	) }}
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
			editable: false, // disable dragging
			eventLimit: true, // allow "more" link when too many events
			eventSources: [{
				url: "/mycalendar/events",
				borderColor: '1px solid #3a87ad',
				backgroundColor: '#3a87ad',
				textColor: 'black'
			}],
			eventRender: function(event, element, view) {
			    if (event.allDay == 1) {
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
			},
			eventClick: function(event, jsEvent, view) {
				location.href = "/mycalendar/update/event/" + event.id;
				return false;
			}
		});

		@if (null !== Session::get('success'))
		setTimeout(function () {
			$('.alert-success').hide('slow');
        }, 8000);
        @endif
        
		@if (null !== Session::get('error'))
		setTimeout(function () {
			$('.alert-danger').hide('slow');
        }, 8000);
        @endif
    });

    </script>
@stop

@section('content')
	<div id="page-wrapper">
		<br/>
		<div class="row rowContainer">
			<div class="col-lg-12">
            	@if (null !== Session::get('success'))
                <div class="alert alert-success">
                {{ Session::get('success') }}
                </div>
                @endif
                
            	@if (null !== Session::get('error'))
                <div class="alert alert-danger">
                {{ Session::get('error') }}
                </div>
                @endif
                
                <div id='calendar'></div>
			</div>
		</div>
	</div>    
@stop