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

		$('#start').datetimepicker({format: 'Y-m-d H:i', lang: 'en'});
		$('#end').datetimepicker({format: 'Y-m-d H:i', lang: 'en'});
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
                            <form name="addEventForm" action="/mycalendar/add/event" method="post" role="form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ (Input::old('title')) }}" />
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
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Notify Me By</label>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="1" name="whereToNotify[]" />
                                                E-mail
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="2" name="whereToNotify[]" />
                                                Facebook
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" value="3" name="whereToNotify[]" />
                                                Twitter
                                            </label>
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
                                            	<input type="checkbox" value="3" name="whenToNotify[]" />
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