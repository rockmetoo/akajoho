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

		$('#start').datetimepicker({format: 'Y-m-d H:i', lang: 'en' });
		$('#end').datetimepicker({format: 'Y-m-d H:i', lang: 'en' });

		@if ($event[0]->whereToNotify & Config::get('akazoho.whereToNotify.Mail'))
			$('#notifyEmail').removeClass('hide');
			$('#notifyEmail').fadeIn('slow');
		@endif

		@if ($event[0]->whereToNotify & Config::get('akazoho.whereToNotify.Facebook'))
			@if (!count($facebookAuth))
				$('#facebookAuth').removeClass('hide');
				$('#facebookAuth').fadeIn('slow');
			@endif
		@endif

		@if ($event[0]->whereToNotify & Config::get('akazoho.whereToNotify.Twitter'))
			@if (!count($twitterAuth))
				$('#twitterAuth').removeClass('hide');
				$('#twitterAuth').fadeIn('slow');
			@endif
		@endif
		
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
                <div class="panel panel-default">
                    <div class="panel-heading">Update a Calendar Event</div>
                    <div class="panel-body">
                        <div class="row">
                            <form name="addEventForm" action="/mycalendar/update/event/{{ $id }}" method="post" role="form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ (Input::old('title')) ? Input::old('title') : $event[0]->title }}" />
                                        @if ($errors->has('title')) <ul class="list_of_error" id="list_of_error_title"><li id="error_item_title_default">Please enter event title (max. 255)</li></ul> @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Start</label>
                                        <input type="text" class="form-control" name="start" id="start" value="{{ (Input::old('start')) ? Input::old('start') : $event[0]->start }}" />
                                        @if ($errors->has('start')) <ul class="list_of_error" id="list_of_error_start"><li id="error_item_start_default">Please enter start time properly</li></ul> @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                	<div class="form-group">
                                    	<label>End</label>
                                       	<input type="text" class="form-control" name="end" id="end" value="{{ (Input::old('end')) ? Input::old('end') : $event[0]->end }}" />
                                        @if ($errors->has('end')) <ul class="list_of_error" id="list_of_error_end"><li id="error_item_end_default">Please enter end time properly</li></ul> @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Memo</label>
                                        <textarea class="form-control" name="eventMemo" value="{{ (Input::old('eventMemo')) ? Input::old('eventMemo') : $event[0]->eventMemo }}"></textarea>
                                        @if ($errors->has('eventMemo')) <ul class="list_of_error" id="list_of_error_eventMemo"><li id="error_item_eventMemo_default">Please write a memo (max. 2048)</li></ul> @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Notify Me By</label>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="1" name="whereToNotify[]" id="emailme" {{ ($event[0]->whereToNotify & Config::get('akazoho.whereToNotify.Mail')) ? "checked" : "" }} />
                                                E-mail
                                            </label>
                                        </div>
                                        <input type="text" class="form-control hide" name="notifyEmail" id="notifyEmail" value="{{ (Input::old('notifyEmail')) ? Input::old('notifyEmail') : $event[0]->notifyEmail }}" />
                                        @if ($errors->has('notifyEmail'))
                                        <ul class="list_of_error" id="list_of_error_notifyEmail">
                                       		<li id="error_item_notifyEmail_default">Please write a memo (max. 2048)</li>
                                       	</ul>
                                       	@endif
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="2" name="whereToNotify[]" id="facebookme" {{ ($event[0]->whereToNotify & Config::get('akazoho.whereToNotify.Facebook')) ? "checked" : "" }} />
                                                Facebook
                                            </label>
                                            @if (!count($facebookAuth))
                                            <button class="btn btn-primary btn-xs hide" type="button" id="facebookAuth">Authorize</button>
                                            @endif
                                        </div>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="4" name="whereToNotify[]" id="twittme" {{ ($event[0]->whereToNotify & Config::get('akazoho.whereToNotify.Twitter')) ? "checked" : "" }} />
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
                                            	<input type="checkbox" value="1" name="whenToNotify[]" {{ ($event[0]->whenToNotify & Config::get('akazoho.whenToNotify.1_day_b4')) ? "checked" : "" }} />
                                                1 Day Before
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="2" name="whenToNotify[]" {{ ($event[0]->whenToNotify & Config::get('akazoho.whenToNotify.3_day_b4')) ? "checked" : "" }} />
                                                3 Days Before
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="4" name="whenToNotify[]" {{ ($event[0]->whenToNotify & Config::get('akazoho.whenToNotify.7_day_b4')) ? "checked" : "" }} />
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
                                    <button type="submit" class="btn btn-default">Update Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop