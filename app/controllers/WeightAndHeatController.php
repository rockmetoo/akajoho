<?php

class WeightAndHeatController extends BaseController
{
	// XXX: IMPORTANT - check user auth status
	public function __construct()
	{
		$this->beforeFilter('isUser');
	}
	
    public function getWeightAndHeat()
    {
    	$userId = Auth::user()->userId;
    	
    	$lastFewEntriesForWeight	= WeightAndHeat::getLastFewEntriesForWeight($userId, 12)->get();
    	$lastFewEntriesForHeat		= WeightAndHeat::getLastFewEntriesForHeat($userId, 12)->get();
    	
    	//$lastWeightMesured			= WeightAndHeat::getLastWeightMesured($userId)->get();
    	//$lastHeatMesured			= WeightAndHeat::getLastHeatMesured($userId)->get();
    	
    	$weight		= array();
    	$heat		= array();
    	
    	foreach ($lastSixEntryForWeight as $oneWeight) {
    		$weight[$oneWeight->year.'-'.$oneWeight->month.'-'.$oneWeight->day] = $oneWeight->weight;
    	}
    	
    	foreach ($lastSixEntryForHeat as $oneHeat) {
    		$heat[$oneHeat->year.'-'.$oneHeat->month.'-'.$oneHeat->day] = $oneHeat->heat;
    	}
    	
    	// XXX: IMPORTANT - sorted by date
    	ksort($weight);
    	ksort($heat);
    	
    	return View::make(
    		'weightandheat.index',
    		[
    			'lastFewEntriesForWeightGraphData'	=> implode(',', $weight),
    			'lastFewEntriesForHeatGraphData'	=> implode(',', $heat),
    			'lastFewWeightTimeSpan'				=> '"'.implode('","', array_keys($weight)).'"',
    			'lastFewHeatTimeSpan'				=> '"'.implode('","', array_keys($heat)).'"',
    			//'lastWeightMesured'					=> count($lastWeightMesured),
    			//'lastHeatMesured'					=> count($lastHeatMesured)
    		]
    	);
    }
    
    public function postWeightAndHeat()
    {
    	// XXX: IMPORTANT - get all post data in one variable to reduce the call for Input::get
    	$postData = Input::all();
    	
    	if (!empty($postData['weightData'])) {
    		// validate the info, create rules for the inputs
    		$rules = array(
    			'weight'	=> 'required|numeric',
    			'when'		=> 'required|date'
    		);
    		 
    		// run the validation rules on the inputs from the form
    		$validator = Validator::make($postData, $rules);
    		
    		// if the validator fails, redirect back to the form
    		if ($validator->fails()) {
    			// send back the input so that we can repopulate the form
    			return Redirect::to('/weight/heat')->withErrors($validator)->withInput();
    		} else {
    			WeightAndHeat::saveWeight(Auth::user()->userId, $postData);
    		
    			return Redirect::to('/weight/heat')->with('weightSuccess', 'Weight data has been inserted successfully ');
    		}
    		
    	} else if (!empty($postData['heatData'])) {
    		// validate the info, create rules for the inputs
    		$rules = array(
    			'heat'		=> 'required|numeric',
    			'when'		=> 'required|date'
    		);
    		 
    		// run the validation rules on the inputs from the form
    		$validator = Validator::make($postData, $rules);
    		
    		// if the validator fails, redirect back to the form
    		if ($validator->fails()) {
    			// send back the input so that we can repopulate the form
    			return Redirect::to('/weight/heat')->withErrors($validator)->withInput();
    		} else {
    			WeightAndHeat::saveHeat(Auth::user()->userId, $postData);
    		
    			return Redirect::to('/weight/heat')->with('heatSuccess', 'Heat data has been inserted successfully ');
    		}
    	}
    }
}
