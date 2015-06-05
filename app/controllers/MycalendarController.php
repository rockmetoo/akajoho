<?php

class MycalendarController extends BaseController
{
    public function getIndex()
    {
    	$cal = Calendar::make();
    	
    	$cal->setBasePath('/mycalendar');
    	$cal->showNav(true);
    	$cal->setDate(Input::get('cdate'));
    	$cal->setView(Input::get('cv'));
    	
    	$cal->setTableClass('table table-striped table-bordered table-hover dataTable no-footer');
    	
    	$cal->setNextIcon('<button class="btn btn-outline btn-default" type="button">Next</button>');
    	$cal->setPrevIcon('<button class="btn btn-outline btn-default" type="button">Previous</button>');
    	$cal->setNextClass('cal_next pull-right');
    	
    	$cal->setMonthIcon('<button class="btn btn-outline btn-default" type="button">Month</button>');
    	$cal->setWeekIcon('<button class="btn btn-outline btn-default" type="button">Week</button>');
    	$cal->setDayIcon('<button class="btn btn-outline btn-default" type="button">Day</button>');
    	
    	$cal->setEvents(array());
    	$calendarHtml = $cal->generate();
    	
		return View::make('mycalendar.index', [ 'calendarHtml' => $calendarHtml ]);
    }
    
    public function getEvents()
    {
    	$start	= Input::get('start');
    	$end	= Input::get('end');
    	
    	// TODO: we can send these as JSON "borderColor":"#5173DA","color":"#99ABEA","textColor":"#000000"
    	$res = MyCalendarEvent::getEventsByStartAndEnd(Auth::user()->userId, $start, $end)->get();
    	
    	if(count($res)) {
    		return Response::json($res->toArray(), 200);
    	} else {
    		return Response::json(array(), 200);
    	}
    }
    
    public function getAddEvent($timestamp)
    {
    	$date		= date('Y-m-d', $timestamp);
    	
    	$facebookAuth = array();
    	$twitterAuth  = array();
    	
    	$res = Sns::getSNSAuth(Auth::user()->userId)->get();
    	
    	if(count($res)) {
    		$facebookAuth	= json_decode($res[0]->facebook);
    		$twitterAuth	= json_decode($res[0]->twitter);
    	}
    	
    	return View::make(
    		'mycalendar.addEvent',
    		[
    			'facebookAuth'	=> $facebookAuth,
    			'twitterAuth'	=> $twitterAuth,
    			'timestamp'		=> $timestamp
    		]
    	);
    }
    
    public function postAddEvent($milliseconds)
    {
    	$timestamp	= $milliseconds/1000;
    	$date		= date('Y-m-d', $timestamp);
    	
    	// XXX: IMPORTANT - get all post data in one variable to reduce the call for Input::get
    	$postData = Input::all();
    	
    	// validate the info, create rules for the inputs
    	$rules = array(
    		'title'			=> 'required|max:255',
    		'start'			=> 'required|date',
    		'end'			=> 'date',
    		'memo'			=> 'max:2048',
    		'notifyEmail'	=> 'email',
    	);
    	
    	// run the validation rules on the inputs from the form
    	$validator = Validator::make($postData, $rules);
    	
    	// if the validator fails, redirect back to the form
    	if ($validator->fails()) {
    		// send back the input so that we can repopulate the form
    		return Redirect::to('/mycalendar/add/event/'.$milliseconds)->withErrors($validator)->withInput();
    	} else {
    		MyCalendarEvent::saveEvent(Auth::user()->userId, $postData);
    	
    		return Redirect::to('/mycalendar')->with('success', 'Calendar event has been updated successfully ');
    	}
    }
    
    public function getUpdateEvent($id)
    {
    	$eventRes = MyCalendarEvent::getEventsById(Auth::user()->userId, $id)->get();
    	
    	if (!count($eventRes)) {
    		return Redirect::to('/mycalendar')->with('error', 'Calendar event does not exist!');
    	}
    	
    	$facebookAuth = array();
    	$twitterAuth  = array();
    	 
    	$res = Sns::getSNSAuth(Auth::user()->userId)->get();
    	 
    	if(count($res)) {
    		$facebookAuth	= json_decode($res[0]->facebook);
    		$twitterAuth	= json_decode($res[0]->twitter);
    	}
    	
    	return View::make(
    		'mycalendar.updateEvent',
    		[
    			'facebookAuth'	=> $facebookAuth,
    			'twitterAuth'	=> $twitterAuth,
    			'id'			=> $id,
    			'event'			=> $eventRes
    		]
    	);
    }
    
    public function postUpdateEvent($id)
    {
    	$userId = Auth::user()->userId;
    	
    	$eventRes = MyCalendarEvent::getEventsById($userId, $id)->get();
    	 
    	if (!count($eventRes)) {
    		return Redirect::to('/mycalendar')->with('error', 'Calendar event does not exist!');
    	}
    	
    	// XXX: IMPORTANT - get all post data in one variable to reduce the call for Input::get
    	$postData = Input::all();
    	 
    	// validate the info, create rules for the inputs
    	$rules = array(
    		'title'			=> 'required|max:255',
    		'start'			=> 'required|date',
    		'end'			=> 'date',
    		'memo'			=> 'max:2048',
    		'notifyEmail'	=> 'email',
    	);
    	 
    	// run the validation rules on the inputs from the form
    	$validator = Validator::make($postData, $rules);
    	 
    	// if the validator fails, redirect back to the form
    	if ($validator->fails()) {
    		// send back the input so that we can repopulate the form
    		return Redirect::to('/mycalendar/update/event/'.$id)->withErrors($validator)->withInput();
    	} else {
    		MyCalendarEvent::updateEvent($userId, $id, $postData);
    		 
    		return Redirect::to('/mycalendar')->with('success', 'Calendar event has been updated successfully ');
    	}
    }
}
