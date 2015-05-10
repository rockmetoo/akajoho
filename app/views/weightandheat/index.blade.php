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
        {{ HTML::script('/js/Chart.min.js', [], true) }}
        {{ HTML::script('/js/Chart.Legend.js', [], true) }}
    @else
    	{{ HTML::script('/js/jquery-1.11.0.js') }}
        {{ HTML::script('/js/jquery.datetimepicker.js') }}
        {{ HTML::script('/js/Chart.min.js') }}
        {{ HTML::script('/js/Chart.Legend.js') }}
    @endif
@stop

@section('internalJSCode')
    <script type="text/javascript">
    jQuery(function($) {

		$('#whenWeight').datetimepicker({format: 'Y-m-d H:i', lang: 'en'});
		$('#whenHeat').datetimepicker({format: 'Y-m-d H:i', lang: 'en'});
		
    	$('#addWeight').click(function() {
    		$('.addWeightSuccess').remove();
    		$('.addWeightRow').removeClass('hidden');
			$('.addWeightRow').show();
		});

    	$('#addHeat').click(function() {
    		$('.addHeatSuccess').remove();
    		$('.addHeatRow').removeClass('hidden');
			$('.addHeatRow').show();
		});

    	setTimeout(function () {
			$('.alert-success').hide('slow');
        }, 8000);
    });

    @if (!empty($lastFewEntriesForWeightGraphData))
    	var lastFewEntriesForWeightGraphData = {
    		labels : [{{ $lastFewWeightTimeSpan }}],
    		datasets : [
    			{
    				label: "Weight",
    				fillColor : "rgba(151,187,205,0.2)",
    				strokeColor : "rgba(151,187,205,1)",
    				pointColor : "rgba(151,187,205,1)",
    				pointStrokeColor : "#fff",
    				pointHighlightFill : "#fff",
    				pointHighlightStroke : "rgba(151,187,205,1)",
    				data : [{{ $lastFewEntriesForWeightGraphData }}]
    			}
    		]
    	}
    @endif

    @if (!empty($lastFewEntriesForHeatGraphData))
    	var lastFewEntriesForHeatGraphData = {
    		labels : [{{ $lastFewHeatTimeSpan }}],
    		datasets : [
    			{
    				label: "Heat",
    				fillColor : "rgba(151,187,205,0.2)",
    				strokeColor : "rgba(151,187,205,1)",
    				pointColor : "rgba(151,187,205,1)",
    				pointStrokeColor : "#fff",
    				pointHighlightFill : "#fff",
    				pointHighlightStroke : "rgba(151,187,205,1)",
    				data : [{{ $lastFewEntriesForHeatGraphData }}]
    			}
    		]
    	}
    @endif
    
    window.onload = function() {

    	@if (!empty($lastFewEntriesForWeightGraphData))
	    	var ctx = document.getElementById("lastFewEntriesForWeightGraph").getContext("2d");
	    	window.myLine = new Chart(ctx).Line(lastFewEntriesForWeightGraphData, {responsive: true});
    	@endif
    	
    	@if (!empty($lastFewEntriesForHeatGraphData))
	    	var ctx = document.getElementById("lastFewEntriesForHeatGraph").getContext("2d");
	    	window.myLine = new Chart(ctx).Line(lastFewEntriesForHeatGraphData, {responsive: true});
    	@endif
    }
    </script>
@stop

@section('content')
	<div id="page-wrapper">
		<div class="row rowContainer">
			<div class="col-lg-4">
				<div class="panel panel-orange">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-2x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge-custom">{{ $lastWeightMesured }}</div>
								<div>Last Weight Measured</div>
							</div>
						</div>
					</div>

					<div class="panel-body">
                    	@if (null !== Session::get('weightSuccess'))
                        <div class="alert alert-success addWeightSuccess" id="#weightSuccess">
                        	{{ Session::get('weightSuccess') }}
                        </div>
                        @endif
                        
                        @if (!empty($lastFewEntriesForWeightGraphData))
                        <div id="morris-area-chart">
                        	<div class="text-center">Last Few Weight Measured</div>
                            <canvas id="lastFewEntriesForWeightGraph"></canvas>
                        </div>
                        @endif
                        
						<div class="row hidden addWeightRow">
							<form name="weightForm" action="/weight/heat#weightSuccess" method="post" role="form">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" id="weightData" name="weightData" value="1" />
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Weight</label>
                                        <input type="number" class="form-control" name="weight" value="{{ (Input::old('weight')) }}" />
                                        @if ($errors->has('weight'))
                                        <ul class="list_of_error" id="list_of_error_weight">
                                        	<li id="error_item_weight_default">
                                        		Weight has to be a numeric value
                                        	</li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>When</label>
                                        <input type="text" class="form-control" name="when" id="whenWeight" value="{{ (Input::old('when')) ? Input::old('when') : date('Y-m-d H:i') }}" />
                                        @if ($errors->has('when'))
                                        <ul class="list_of_error" id="list_of_error_when">
                                        	<li id="error_item_when_default">
                                        		Enter weight measuring date and time
                                        	</li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
								<div class="col-lg-12">
                                    <button type="submit" class="btn btn-default">Save</button>
                                </div>
							</form>
						</div>
					</div>
					
					<a id="addWeight" href="#addWeight" onclick="return false;">
						<div class="panel-footer">
							<span class="pull-left">Add</span>
							<span class="pull-right"><i class="fa fa-plus-square"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-2x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge-custom">{{ $lastHeatMesured }}</div>
								<div>Last Heat Measured</div>
							</div>
						</div>
					</div>

					<div class="panel-body">
                    	@if (null !== Session::get('heatSuccess'))
                        <div class="alert alert-success addHeatSuccess" id="heatSuccess">
                        	{{ Session::get('heatSuccess') }}
                        </div>
                        @endif
                        
                        @if (!empty($lastFewEntriesForHeatGraphData))
                        <div id="morris-area-chart">
                        	<div class="text-center">Last Few Heats Measured</div>
                            <canvas id="lastFewEntriesForHeatGraph"></canvas>
                        </div>
                        @endif
                        
						<div class="row hidden addHeatRow">
							<form name="heatForm" action="/weight/heat#heatSuccess" method="post" role="form">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" id="heatData" name="heatData" value="1" />
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Heat</label>
                                        <input type="number" class="form-control" name="heat" value="{{ (Input::old('heat')) }}" />
                                        @if ($errors->has('heat'))
                                        <ul class="list_of_error" id="list_of_error_heat">
                                        	<li id="error_item_heat_default">
                                        		Heat has to be a numeric value
                                        	</li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>When</label>
                                        <input type="text" class="form-control" name="when" id="whenHeat" value="{{ (Input::old('when')) ? Input::old('when') : date('Y-m-d H:i') }}" />
                                        @if ($errors->has('when'))
                                        <ul class="list_of_error" id="list_of_error_when">
                                        	<li id="error_item_when_default">
                                        		Enter heat measuring date and time
                                        	</li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
								<div class="col-lg-12">
                                    <button type="submit" class="btn btn-default">Save</button>
                                </div>
							</form>
						</div>
					</div>
					
					<a id="addHeat" href="#addHeat" onclick="return false;">
						<div class="panel-footer">
							<span class="pull-left">Add</span>
							<span class="pull-right"><i class="fa fa-plus-square"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>    
@stop