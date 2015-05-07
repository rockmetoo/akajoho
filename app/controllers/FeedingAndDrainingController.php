<?php

class FeedingAndDrainingController extends BaseController
{
	// XXX: IMPORTANT - check user auth status
	public function __construct()
	{
		$this->beforeFilter('isUser');
	}
	
    public function getFeedingAndDraining()
    {
    	$userId = Auth::user()->userId;
    	
    	$lastSixFeedingEntryForToday	= DailyData::getLastSixFeedingEntryForToday($userId)->get();
    	
    	$lastSixDaysTotalPoop			= DailyData::getLastSixDaysTotalPoop($userId)->get();
    	$lastSixDaysTotalUrination		= DailyData::getLastSixDaysTotalUrination($userId)->get();
    	
    	$totalPoopForToday				= DailyData::getTotalPoopForToday($userId)->get();
    	$totalUrinationForToday			= DailyData::getTotalUrinationForToday($userId)->get();
    	
    	$breastMilk = array('quantity' => array(), 'time' => array());
    	$powderMilk = array('quantity' => array(), 'time' => array());
    	$plainWater = array('quantity' => array(), 'time' => array());
    	
    	$lastSixDays	= getLastNDays(6, 'Y-m-d', 0);
    	$urination		= array();
    	$poop			= array();
    	
    	foreach ($lastSixFeedingEntryForToday as $oneFeed) {
    		
    		if ($oneFeed->diet == 1) {
    			$breastMilk['quantity'][] = $oneFeed->quantity;
    			$breastMilk['time'][] = '"'.$oneFeed->hour.':'.$oneFeed->minute.'"';
    		} else if ($oneFeed->diet == 2) {
    			$powderMilk['quantity'][] = $oneFeed->quantity;
    			$powderMilk['time'][] = '"'.$oneFeed->hour.':'.$oneFeed->minute.'"';
    		} else if ($oneFeed->diet == 3) {
    			$plainWater['quantity'][] = $oneFeed->quantity;
    			$plainWater['time'][] = '"'.$oneFeed->hour.':'.$oneFeed->minute.'"';
    		}
    	}
    	
    	foreach ($lastSixDaysTotalUrination as $oneUrination) {
    		$urination[$oneUrination->year.'-'.$oneUrination->month.'-'.$oneUrination->day] = $oneUrination->totalUrination;
    	}
    	
    	foreach ($lastSixDaysTotalPoop as $onePoop) {
    		$poop[$onePoop->year.'-'.$onePoop->month.'-'.$onePoop->day] = $onePoop->totalPoop;
    	}
    	
    	foreach ($lastSixDays as $index => $date) {
    		if (empty($urination[$date]))	$urination[$date]	= 0;
    		if (empty($poop[$date]))		$poop[$date]		= 0;
    	}
    	
    	if (count($lastSixDaysTotalUrination)) {
    		// XXX: IMPORTANT - sorted by date
    		ksort($urination);
    	} else {
    		$urination = array();
    	}
    	
    	if (count($lastSixDaysTotalPoop)) {
    		// XXX: IMPORTANT - sorted by date
    		ksort($poop);
    	} else {
    		$poop = array();
    	}
    	
    	return View::make(
    		'feedinganddraining.index',
    		[
    			'dailyBreastFeedingGraphData'		=> implode(',', $breastMilk['quantity']),
    			'dailyPowderMilkFeedingGraphData'	=> implode(',', $powderMilk['quantity']),
    			'dailyPlainWaterFeedingGraphData'	=> implode(',', $plainWater['quantity']),
    			'dailyBreastFeedingTimeSpan'		=> implode(',', $breastMilk['time']),
    			'dailyPowderMilkFeedingTimeSpan'	=> implode(',', $powderMilk['time']),
    			'dailyPlainWaterFeedingTimeSpan'	=> implode(',', $plainWater['time']),
    			'lastSixDaysTotalUrinationGraphData'=> implode(',', $urination),
    			'lastSixDaysTotalPoopGraphData'		=> implode(',', $poop),
    			'lastSixDaysTimeSpan'				=> '"'.implode('","', $lastSixDays).'"',
    			'totalFeeding'						=> count($lastSixFeedingEntryForToday),
    			'totalUrination'					=> $totalUrinationForToday[0]->totalUrinationForToday,
    			'totalPoop'							=> $totalPoopForToday[0]->totalPoopForToday
    		]
    	);
    }
    
    public function postFeedingAndDraining()
    {
    	// XXX: IMPORTANT - get all post data in one variable to reduce the call for Input::get
    	$postData = Input::all();
    	
    	if (!empty($postData['feedingData'])) {
    		// validate the info, create rules for the inputs
    		$rules = array(
    			'diet'		=> 'required',
    			'quantity'	=> 'required|numeric',
    			'when'		=> 'required|date'
    		);
    		 
    		// run the validation rules on the inputs from the form
    		$validator = Validator::make($postData, $rules);
    		
    		// if the validator fails, redirect back to the form
    		if ($validator->fails()) {
    			// send back the input so that we can repopulate the form
    			return Redirect::to('/feeding/draining')->withErrors($validator)->withInput();
    		} else {
    			DailyData::saveFeeding(Auth::user()->userId, $postData);
    		
    			return Redirect::to('/feeding/draining')->with('feedingSuccess', 'Feeding data has been inserted successfully ');
    		}
    		
    	} else if (!empty($postData['urinationData'])) {
    		// validate the info, create rules for the inputs
    		$rules = array(
    			'color'		=> 'required',
    			'when'		=> 'required|date'
    		);
    		 
    		// run the validation rules on the inputs from the form
    		$validator = Validator::make($postData, $rules);
    		
    		// if the validator fails, redirect back to the form
    		if ($validator->fails()) {
    			// send back the input so that we can repopulate the form
    			return Redirect::to('/feeding/draining')->withErrors($validator)->withInput();
    		} else {
    			DailyData::saveUrination(Auth::user()->userId, $postData);
    		
    			return Redirect::to('/feeding/draining')->with('urinationSuccess', 'Urination data has been inserted successfully ');
    		}
    	} else if (!empty($postData['poopData'])) {
    		// validate the info, create rules for the inputs
    		$rules = array(
    			'color'		=> 'required',
    			'type'		=> 'required',
    			'when'		=> 'required|date'
    		);
    		 
    		// run the validation rules on the inputs from the form
    		$validator = Validator::make($postData, $rules);
    		
    		// if the validator fails, redirect back to the form
    		if ($validator->fails()) {
    			// send back the input so that we can repopulate the form
    			return Redirect::to('/feeding/draining')->withErrors($validator)->withInput();
    		} else {
    			DailyData::savePoop(Auth::user()->userId, $postData);
    		
    			return Redirect::to('/feeding/draining')->with('poopSuccess', 'Pooping data has been inserted successfully ');
    		}
    	}
    }
}
