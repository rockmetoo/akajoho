<?php

class MycalendarController extends BaseController
{
    public function getIndex()
    {
		return View::make('mycalendar.index');
    }
    
    public function getEvents()
    {
    	return Response::json(array(), 200);
    }
    
    public function getAddEvents($milliseconds)
    {
    	$timestamp = $milliseconds/1000;
    	$date = date('Y-m-d', $timestamp);
    	return View::make('mycalendar.addEvent');
    }
    
    public function postAddEvents()
    {
    	return Response::json(array(), 200);
    }
}
