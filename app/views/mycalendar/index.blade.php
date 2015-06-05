@extends('layouts.akachanHeader')

@include('layouts.leftsidemenu')

@include('layouts.leftSideUserBlock')

@section('internalCSSLibrary')
@stop

@section('internalJSLibrary')
    @if (App::environment('production'))
    	{{ HTML::script('/js/jquery-1.11.0.js', [], true) }}
    @else
    	{{ HTML::script('/js/jquery-1.11.0.js') }}
    @endif
@stop

@section('internalJSCode')
    <script type="text/javascript">
    jQuery(function($) {
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
                
                {{ $calendarHtml }}
			</div>
		</div>
	</div>    
@stop