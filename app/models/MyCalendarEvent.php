<?php

class MyCalendarEvent extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table       = 'calendar';
    
    protected $primaryKey  = 'id';

    /**
     * Stopping automatically inserting updated_at/created_at
     *
     * @var boolean
     */
    public $timestamps  = false;

    public function scopeGetEventsByStartAndEnd($query, $userId, $start, $end)
    {
        $res = $query->selectRaw('id, title, start')
        ->where('userId', $userId)
        ->whereRAW("start BETWEEN DATE('$start') AND DATE('$end')");
    
        return $res;
    }
    
    public function scopeGetEventsById($query, $userId, $id)
    {
    	$res = $query->selectRaw('id, title, start, end, eventMemo as url, allDay as allday, whereToNotify, whenToNotify, notifyEmail, isYearlyEvent')
    	->where('userId', $userId)
    	->where('id', $id);
    
    	return $res;
    }
    
    public function scopeSaveEvent($query, $userId, $postData)
    {
        $now = date('Y-m-d H:i:s');
        
        $whereToNotify	= null;
        $whenToNotify	= null;
        
        if (!empty($postData['whereToNotify']))
        	$whereToNotify	= array_reduce($postData['whereToNotify'], function($a, $b) { return $a | $b; });
        
        if (!empty($postData['whenToNotify']))
        	$whenToNotify	= array_reduce($postData['whenToNotify'], function($a, $b) { return $a | $b; });
        
        $dataForEvent = array(
            'userId'    	=> $userId,
        	'title'			=> $postData['title'],
        	'start'			=> $postData['start'],
        	'end'			=> (!empty($postData['end'])) ? $postData['end'] : null,
        	'eventMemo'		=> $postData['eventMemo'],
        	'allDay'		=> (!empty($postData['allDay'])) ? $postData['allDay'] : 0,
        	'whereToNotify'	=> $whereToNotify,
        	'whenToNotify'	=> $whenToNotify,
        	'notifyEmail'	=> (!empty($postData['notifyEmail'])) ? $postData['notifyEmail'] : null,
        	'isYearlyEvent'	=> (!empty($postData['isYearlyEvent'])) ? $postData['isYearlyEvent'] : 0,
        	'createdBy'		=> $userId,
        	'updatedBy'		=> $userId,
            'dateCreated'	=> $now,
            'dateUpdated'	=> $now
        );
        
        $query->insert($dataForEvent);
    }
    
    public function scopeUpdateEvent($query, $userId, $id, $postData)
    {
    	$now = date('Y-m-d H:i:s');
    
    	$whereToNotify	= null;
    	$whenToNotify	= null;
    
    	if (!empty($postData['whereToNotify']))
    		$whereToNotify	= array_reduce($postData['whereToNotify'], function($a, $b) { return $a | $b; });
    
    	if (!empty($postData['whenToNotify']))
    		$whenToNotify	= array_reduce($postData['whenToNotify'], function($a, $b) { return $a | $b; });
    
    	$dataForEvent = array(
    		'title'			=> $postData['title'],
    		'start'			=> $postData['start'],
    		'end'			=> (!empty($postData['end'])) ? $postData['end'] : null,
    		'eventMemo'		=> $postData['eventMemo'],
    		'allDay'		=> (!empty($postData['allDay'])) ? $postData['allDay'] : 0,
    		'whereToNotify'	=> $whereToNotify,
    		'whenToNotify'	=> $whenToNotify,
    		'notifyEmail'	=> (!empty($postData['notifyEmail'])) ? $postData['notifyEmail'] : null,
    		'isYearlyEvent'	=> (!empty($postData['isYearlyEvent'])) ? $postData['isYearlyEvent'] : 0,
    		'updatedBy'		=> $userId,
    		'dateUpdated'	=> $now
    	);
    
    	$query->where('userId', $userId)->where('id', $id)->update($dataForEvent);
    }
}
