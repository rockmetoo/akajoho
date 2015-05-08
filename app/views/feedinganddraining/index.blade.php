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
    @else
        {{ HTML::script('/js/jquery-1.11.0.js') }}
        {{ HTML::script('/js/jquery.datetimepicker.js') }}
        {{ HTML::script('/js/Chart.min.js') }}
    @endif
@stop

@section('internalJSCode')
    <script type="text/javascript">
    jQuery(function($) {

		$('#whenFeeding').datetimepicker({format: 'Y-m-d H:i', lang: 'en'});
		$('#whenUrination').datetimepicker({format: 'Y-m-d H:i', lang: 'en'});
		$('#whenPoop').datetimepicker({format: 'Y-m-d H:i', lang: 'en'});
		
    	$('#addFeeding').click(function() {
    		$('.addFeedingSuccess').remove();
    		$('.addFeedingRow').removeClass('hidden');
			$('.addFeedingRow').show();
		});

    	$('#addUrination').click(function() {
    		$('.addUrinationSuccess').remove();
    		$('.addUrinationRow').removeClass('hidden');
			$('.addUrinationRow').show();
		});

    	$('#addPoop').click(function() {
    		$('.addPoopSuccess').remove();
    		$('.addPoopRow').removeClass('hidden');
			$('.addPoopRow').show();
		});

    	setTimeout(function () {
			$('.alert-success').hide('slow');
        }, 8000);

        $(".multipleFeedingGraph div").each(function(e) {
            if (e != 0) $(this).hide();
        });
        
        $("#nextFeedingGraph").click(function() {
            if ($(".multipleFeedingGraph div:visible").next().length != 0) {
                $(".multipleFeedingGraph div:visible").next().show().prev().hide();

                var $canvasId = $(".multipleFeedingGraph div:visible").find("canvas").attr('id');
            	$(".multipleFeedingGraph div:visible").empty();
				var $canvas = $("<canvas>", {id: $canvasId});
            	$(".multipleFeedingGraph div:visible").append($canvas);
    	    	var ctx = document.getElementById($canvasId).getContext("2d");
    	    	if ($canvasId == 'dailyBreastFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyBreastFeedingGraphData, {responsive: true});
    	    	else if ($canvasId == 'dailyPowderMilkFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyPowderMilkFeedingGraphData, {responsive: true});
    	    	else if ($canvasId == 'dailyPlainWaterFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyPlainWaterFeedingGraphData, {responsive: true});
            } else {
                $(".multipleFeedingGraph div:visible").hide();
                $(".multipleFeedingGraph div:first").show();

                var $canvasId = $(".multipleFeedingGraph div:first").find("canvas").attr('id');
            	$(".multipleFeedingGraph div:first").empty();
				var $canvas = $("<canvas>", {id: $canvasId});
            	$(".multipleFeedingGraph div:first").append($canvas);
    	    	var ctx = document.getElementById($canvasId).getContext("2d");
    	    	if ($canvasId == 'dailyBreastFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyBreastFeedingGraphData, {responsive: true});
    	    	else if ($canvasId == 'dailyPowderMilkFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyPowderMilkFeedingGraphData, {responsive: true});
    	    	else if ($canvasId == 'dailyPlainWaterFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyPlainWaterFeedingGraphData, {responsive: true});
            }
            
            return false;
        });

        $("#prevFeedingGraph").click(function() {
            if ($(".multipleFeedingGraph div:visible").prev().length != 0) {
                $(".multipleFeedingGraph div:visible").prev().show().next().hide();

                var $canvasId = $(".multipleFeedingGraph div:visible").find("canvas").attr('id');
            	$(".multipleFeedingGraph div:visible").empty();
				var $canvas = $("<canvas>", {id: $canvasId});
            	$(".multipleFeedingGraph div:visible").append($canvas);
    	    	var ctx = document.getElementById($canvasId).getContext("2d");
    	    	if ($canvasId == 'dailyBreastFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyBreastFeedingGraphData, {responsive: true});
    	    	else if ($canvasId == 'dailyPowderMilkFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyPowderMilkFeedingGraphData, {responsive: true});
    	    	else if ($canvasId == 'dailyPlainWaterFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyPlainWaterFeedingGraphData, {responsive: true});
            } else {
                $(".multipleFeedingGraph div:visible").hide();
                $(".multipleFeedingGraph div:last").show();

                var $canvasId = $(".multipleFeedingGraph div:last").find("canvas").attr('id');
            	$(".multipleFeedingGraph div:last").empty();
				var $canvas = $("<canvas>", {id: $canvasId});
            	$(".multipleFeedingGraph div:last").append($canvas);
    	    	var ctx = document.getElementById($canvasId).getContext("2d");
    	    	if ($canvasId == 'dailyBreastFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyBreastFeedingGraphData, {responsive: true});
    	    	else if ($canvasId == 'dailyPowderMilkFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyPowderMilkFeedingGraphData, {responsive: true});
    	    	else if ($canvasId == 'dailyPlainWaterFeedingGraph')
    	    		window.myLine = new Chart(ctx).Line(dailyPlainWaterFeedingGraphData, {responsive: true});
            }
            
            return false;
        });
    });

    @if (!empty($dailyBreastFeedingGraphData))
    	var dailyBreastFeedingGraphData = {
    		labels : [{{ $dailyBreastFeedingTimeSpan }}],
    		datasets : [
    			{
    				label: "Breast Milk",
    				fillColor : "rgba(151,187,205,0.2)",
    				strokeColor : "rgba(151,187,205,1)",
    				pointColor : "rgba(151,187,205,1)",
    				pointStrokeColor : "#fff",
    				pointHighlightFill : "#fff",
    				pointHighlightStroke : "rgba(151,187,205,1)",
    				data : [{{ $dailyBreastFeedingGraphData }}]
    			}
    		]
    	}
    @endif

    @if (!empty($dailyPowderMilkFeedingGraphData))
    	var dailyPowderMilkFeedingGraphData = {
    		labels : [{{ $dailyPowderMilkFeedingTimeSpan }}],
    		datasets : [
    			{
    				label: "Powder Milk",
    				fillColor : "rgba(151,187,205,0.2)",
    				strokeColor : "rgba(151,187,205,1)",
    				pointColor : "rgba(151,187,205,1)",
    				pointStrokeColor : "#fff",
    				pointHighlightFill : "#fff",
    				pointHighlightStroke : "rgba(151,187,205,1)",
    				data : [{{ $dailyPowderMilkFeedingGraphData }}]
    			}
    		]
    	}
    @endif

    @if (!empty($dailyPlainWaterFeedingGraphData))
    	var dailyPlainWaterFeedingGraphData = {
    		labels : [{{ $dailyPlainWaterFeedingTimeSpan }}],
    		datasets : [
    			{
    				label: "Plain Water",
    				fillColor : "rgba(151,187,205,0.2)",
    				strokeColor : "rgba(151,187,205,1)",
    				pointColor : "rgba(151,187,205,1)",
    				pointStrokeColor : "#fff",
    				pointHighlightFill : "#fff",
    				pointHighlightStroke : "rgba(151,187,205,1)",
    				data : [{{ $dailyPlainWaterFeedingGraphData }}]
    			}
    		]
    	}
    @endif

    @if (!empty($lastSixDaysTotalUrinationGraphData))
    	var lastSixDaysTotalUrinationGraphData = {
    		labels : [{{ $lastSixDaysTimeSpan }}],
    		datasets : [
    			{
    				label: "Urination",
    				fillColor : "rgba(151,187,205,0.2)",
    				strokeColor : "rgba(151,187,205,1)",
    				pointColor : "rgba(151,187,205,1)",
    				pointStrokeColor : "#fff",
    				pointHighlightFill : "#fff",
    				pointHighlightStroke : "rgba(151,187,205,1)",
    				data : [{{ $lastSixDaysTotalUrinationGraphData }}]
    			}
    		]
    	}
    @endif
    
    @if (!empty($lastSixDaysTotalPoopGraphData))
    	var lastSixDaysTotalPoopGraphData = {
    		labels : [{{ $lastSixDaysTimeSpan }}],
    		datasets : [
    			{
    				label: "Poop",
    				fillColor : "rgba(151,187,205,0.2)",
    				strokeColor : "rgba(151,187,205,1)",
    				pointColor : "rgba(151,187,205,1)",
    				pointStrokeColor : "#fff",
    				pointHighlightFill : "#fff",
    				pointHighlightStroke : "rgba(151,187,205,1)",
    				data : [{{ $lastSixDaysTotalPoopGraphData }}]
    			}
    		]
    	}
    @endif
    
    window.onload = function() {
    	@if (!empty($dailyBreastFeedingGraphData))
	    	var ctx = document.getElementById("dailyBreastFeedingGraph").getContext("2d");
	    	window.myLine = new Chart(ctx).Line(dailyBreastFeedingGraphData, {responsive: true});
    	@endif

    	@if (!empty($dailyPowderMilkFeedingGraphData))
	    	var ctx = document.getElementById("dailyPowderMilkFeedingGraph").getContext("2d");
	    	window.myLine = new Chart(ctx).Line(dailyPowderMilkFeedingGraphData, {responsive: true});
    	@endif

    	@if (!empty($dailyPlainWaterFeedingGraphData))
	    	var ctx = document.getElementById("dailyPlainWaterFeedingGraph").getContext("2d");
	    	window.myLine = new Chart(ctx).Line(dailyPlainWaterFeedingGraphData, {responsive: true});
    	@endif

    	@if (!empty($lastSixDaysTotalUrinationGraphData))
	    	var ctx = document.getElementById("lastSixDaysTotalUrinationGraph").getContext("2d");
	    	window.myLine = new Chart(ctx).Line(lastSixDaysTotalUrinationGraphData, {responsive: true});
    	@endif
    	
    	@if (!empty($lastSixDaysTotalPoopGraphData))
	    	var ctx = document.getElementById("lastSixDaysTotalPoopGraph").getContext("2d");
	    	window.myLine = new Chart(ctx).Line(lastSixDaysTotalPoopGraphData, {responsive: true});
    	@endif
    }
    </script>
@stop

@section('content')
	<div id="page-wrapper">
		<br/><br/>
		<div class="row rowContainer">
			<div class="col-lg-4">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-2x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge-custom">{{ $totalFeeding }}</div>
								<div>Feeding Today</div>
							</div>
						</div>
					</div>
					
					<div class="panel-body">
                    	@if (null !== Session::get('feedingSuccess'))
                        <div class="alert alert-success addFeedingSuccess">
                        	{{ Session::get('feedingSuccess') }}
                        </div>
                        @endif
                        
                        <div class="multipleFeedingGraph">
	                        @if (!empty($dailyBreastFeedingGraphData))
	                        <div id="morris-area-chart" class="cls1">
	                        	<p class="text-center" style="margin: 0px">Today's Breast Milk Feeding</p>
	                            <canvas id="dailyBreastFeedingGraph"></canvas>
	                        </div>
	                        @endif
	                        
	                        @if (!empty($dailyPowderMilkFeedingGraphData))
	                        <div id="morris-area-chart" class="cls2">
	                        	<p class="text-center" style="margin: 0px">Today's Powder Milk Feeding</p>
	                            <canvas id="dailyPowderMilkFeedingGraph"></canvas>
	                        </div>
	                        @endif
	                        
	                        @if (!empty($dailyPlainWaterFeedingGraphData))
	                        <div id="morris-area-chart" class="cls3">
	                        	<p class="text-center" style="margin: 0px">Today's Plain Water Feeding</p>
	                            <canvas id="dailyPlainWaterFeedingGraph"></canvas>
	                        </div>
	                        @endif
                        </div>
						
						@if (!empty($dailyBreastFeedingGraphData) || !empty($dailyPowderMilkFeedingGraphData) || !empty($dailyPlainWaterFeedingGraphData))
						<button id="nextFeedingGraph" class="btn btn-outline btn-primary pull-left" type="button">&gt;</button>
	                    <button id="prevFeedingGraph" class="btn btn-outline btn-primary pull-right" type="button">&lt;</button>
	                    @endif
	                    
						<div class="row hidden addFeedingRow">
							<form name="feedingForm" action="/feeding/draining" method="post" role="form">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" id="feedingData" name="feedingData" value="1" />
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Diet</label>
                                        <select class="form-control" name="diet" id="diet">
                                            @foreach (Config::get('feeding.diets') as $key=>$text)
                                                <option value="{{ $key }}">{{ $text }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('diet'))
                                        <ul class="list_of_error" id="list_of_error_diet">
                                        	<li id="error_item_diet_default">
                                        		Please select a diet
                                        	</li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text" class="form-control" name="quantity" value="{{ (Input::old('quantity')) }}" />
                                        @if ($errors->has('quantity'))
                                        <ul class="list_of_error" id="list_of_error_quantity">
                                        	<li id="error_item_quantity_default">
                                        		Quantity has to be a numeric value
                                        	</li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>When</label>
                                        <input type="text" class="form-control" name="when" id="whenFeeding" value="{{ (Input::old('when')) ? Input::old('when') : date('Y-m-d H:i') }}" />
                                        @if ($errors->has('when'))
                                        <ul class="list_of_error" id="list_of_error_when">
                                        	<li id="error_item_when_default">
                                        		Enter feeding date and time
                                        	</li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
								<div class="col-lg-12">
                                    <button type="submit" class="btn btn-default">Add</button>
                                </div>
							</form>
						</div>
					</div>
					
					<a id="addFeeding" href="#">
						<div class="panel-footer">
							<span class="pull-left">Add</span>
							<span class="pull-right"><i class="fa fa-plus-square"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-2x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge-custom">{{ $totalUrination }}</div>
								<div>Urination Today</div>
							</div>
						</div>
					</div>

					<div class="panel-body">
                    	@if (null !== Session::get('urinationSuccess'))
                        <div class="alert alert-success addUrinationSuccess">
                        	{{ Session::get('urinationSuccess') }}
                        </div>
                        @endif
                        
                        @if (!empty($lastSixDaysTotalUrinationGraphData))
                        <div id="morris-area-chart">
                        	<div class="text-center">Last Few Urination</div>
                            <canvas id="lastSixDaysTotalUrinationGraph"></canvas>
                        </div>
                        @endif
                        
						<div class="row hidden addUrinationRow">
							<form name="urinationForm" action="/feeding/draining" method="post" role="form">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" id="urinationData" name="urinationData" value="1" />
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Urin Color</label>
                                        <select class="form-control" name="color" id="color">
                                            @foreach (Config::get('urination.colors') as $key=>$text)
                                                <option value="{{ $key }}">{{ $text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>When</label>
                                        <input type="text" class="form-control" name="when" id="whenUrination" value="{{ (Input::old('when')) ? Input::old('when') : date('Y-m-d H:i') }}" />
                                        @if ($errors->has('when'))
                                        <ul class="list_of_error" id="list_of_error_when">
                                        	<li id="error_item_when_default">
                                        		Enter urination date and time
                                        	</li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
								<div class="col-lg-12">
                                    <button type="submit" class="btn btn-default">Add</button>
                                </div>
							</form>
						</div>
					</div>
					
					<a id="addUrination" href="#">
						<div class="panel-footer">
							<span class="pull-left">Add</span>
							<span class="pull-right"><i class="fa fa-plus-square"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-2x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge-custom">{{ $totalPoop }}</div>
								<div>Poop Today</div>
							</div>
						</div>
					</div>
					
					<div class="panel-body">
                    	@if (null !== Session::get('poopSuccess'))
                        <div class="alert alert-success addPoopSuccess">
                        	{{ Session::get('poopSuccess') }}
                        </div>
                        @endif
                        
                        @if (!empty($lastSixDaysTotalPoopGraphData))
                        <div id="morris-area-chart">
                        	<div class="text-center">Last Few Poop</div>
                            <canvas id="lastSixDaysTotalPoopGraph"></canvas>
                        </div>
                        @endif
						
						<div class="row hidden addPoopRow">
							<form name="poopForm" action="/feeding/draining" method="post" role="form">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" id="poopData" name="poopData" value="1" />
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Poop Color</label>
                                        <select class="form-control" name="color" id="color">
                                            @foreach (Config::get('poop.colors') as $key=>$text)
                                                <option value="{{ $key }}">{{ $text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Poop Hardness</label>
                                        <select class="form-control" name="type" id="type">
                                            @foreach (Config::get('poop.types') as $key=>$text)
                                                <option value="{{ $key }}">{{ $text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>When</label>
                                        <input type="text" class="form-control" name="when" id="whenPoop" value="{{ (Input::old('when')) ? Input::old('when') : date('Y-m-d H:i') }}" />
                                        @if ($errors->has('when'))
                                        <ul class="list_of_error" id="list_of_error_when">
                                        	<li id="error_item_when_default">
                                        		Enter pooping date and time
                                        	</li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
								<div class="col-lg-2">
                                    <button type="submit" class="btn btn-default">Add</button>
                                </div>
								<div class="col-lg-6">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="1" name="includeUrination">Is Urination?
										</label>
									</div>
                                </div>
							</form>
						</div>
					</div>
					
					<a id="addPoop" href="#">
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