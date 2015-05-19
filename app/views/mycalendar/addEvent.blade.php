@extends('layouts.akachanHeader')

@include('layouts.leftsidemenu')

@include('layouts.leftSideUserBlock')

@section('internalCSSLibrary')
    @if (App::environment('production'))
    	{{ HTML::style('/css/jquery.datetimepicker.css', [], true) }}
    @else
    	{{ HTML::style('/css/jquery.datetimepicker.css') }}
    @endif
@stop

@section('internalJSLibrary')
    @if (App::environment('production'))
    	{{ HTML::script('/js/jquery-1.11.0.js', [], true) }}
        {{ HTML::script('/js/jquery.datetimepicker.js', [], true) }}
    @else
    	{{ HTML::script('/js/jquery-1.11.0.js') }}
        {{ HTML::script('/js/jquery.datetimepicker.js') }}
    @endif
@stop

@section('internalJSCode')
    <script type="text/javascript">
    jQuery(function($) {

		$('#start').datetimepicker({format: 'Y-m-d H:i', lang: 'en', minDate: new Date({{ $milliseconds }}) });
		$('#end').datetimepicker({format: 'Y-m-d H:i', lang: 'en', minDate: new Date({{ $milliseconds }}) });

		$('#emailme').change(function() {
			if (this.checked) {
				$('#notifyEmail').removeClass('hide');
				$('#notifyEmail').fadeIn('slow');
			} else {
				$('#notifyEmail').fadeOut('slow');
			}
	    });
	    
		@if (!count($facebookAuth))
		$('#facebookme').change(function() {
			if (this.checked) {
				$('#facebookAuth').removeClass('hide');
				$('#facebookAuth').fadeIn('slow');
			} else {
				$('#facebookAuth').fadeOut('slow');
			}
	    });
	    @endif

	    @if (!count($twitterAuth))
		$('#twittme').change(function() {
			if (this.checked) {
				$('#twitterAuth').removeClass('hide');
				$('#twitterAuth').fadeIn('slow');
			} else {
				$('#twitterAuth').fadeOut('slow');
			}
	    });
	    @endif

	    $('#facebookAuth').click(function() {
	        location.href = '/get/fb/token';
	        return false;
	    });
    });
    </script>
@stop

@section('content')
    <div id="page-wrapper">
        <br/>
        <div class="row rowContainer">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Add a Calendar Event</div>
                    <div class="panel-body">
                        <div class="row">
                            <form name="addEventForm" action="/mycalendar/add/event/{{ $milliseconds }}" method="post" role="form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ (Input::old('title')) }}" />
                                        @if ($errors->has('title')) <ul class="list_of_error" id="list_of_error_title"><li id="error_item_title_default">Please enter event title (max. 255)</li></ul> @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Start</label>
                                        <input type="text" class="form-control" name="start" id="start" value="{{ (Input::old('start')) }}" />
                                        @if ($errors->has('start')) <ul class="list_of_error" id="list_of_error_start"><li id="error_item_start_default">Please enter start time properly</li></ul> @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                	<div class="form-group">
                                    	<label>End</label>
                                       	<input type="text" class="form-control" name="end" id="end" value="{{ (Input::old('end')) }}" />
                                        @if ($errors->has('end')) <ul class="list_of_error" id="list_of_error_end"><li id="error_item_end_default">Please enter end time properly</li></ul> @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Memo</label>
                                        <textarea class="form-control" name="eventMemo" value="{{ (Input::old('eventMemo')) }}"></textarea>
                                        @if ($errors->has('eventMemo')) <ul class="list_of_error" id="list_of_error_eventMemo"><li id="error_item_eventMemo_default">Please write a memo (max. 2048)</li></ul> @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Notify Me By</label>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="1" name="whereToNotify[]" id="emailme" />
                                                E-mail
                                            </label>
                                        </div>
                                        <input type="text" class="form-control hide" name="notifyEmail" id="notifyEmail" value="{{ (Input::old('notifyEmail')) }}" />
                                        @if ($errors->has('notifyEmail'))
                                        <ul class="list_of_error" id="list_of_error_notifyEmail">
                                       		<li id="error_item_notifyEmail_default">Please write a memo (max. 2048)</li>
                                       	</ul>
                                       	@endif
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="2" name="whereToNotify[]" id="facebookme" />
                                                Facebook
                                            </label>
                                            @if (!count($facebookAuth))
                                            <button class="btn btn-primary btn-xs hide" type="button" id="facebookAuth">Authorize</button>
                                            @endif
                                        </div>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="4" name="whereToNotify[]" id="twittme" />
                                                Twitter
                                            </label>
                                            @if (!count($twitterAuth))
                                            <button class="btn btn-primary btn-xs hide" type="button"  id="twitterAuth">Authorize</button>
                                            @endif
                                        </div>
                                        @if ($errors->has('whereToNotify'))
                                        	<ul class="list_of_error" id="list_of_error_whereToNotify">
                                         		<li id="error_item_whereToNotify_default">Select properly</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Notify Me At</label>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="1" name="whenToNotify[]" />
                                                1 Day Before
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="2" name="whenToNotify[]" />
                                                3 Days Before
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="4" name="whenToNotify[]" />
                                                7 Days Before
                                            </label>
                                        </div>
                                        @if ($errors->has('whereToNotify'))
                                        	<ul class="list_of_error" id="list_of_error_whenToNotify">
                                         		<li id="error_item_whenToNotify_default">Select properly</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-default">Add Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop