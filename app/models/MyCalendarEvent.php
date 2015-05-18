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
    	//SELECT * FROM calendar WHERE start BETWEEN DATE('2015-05-01') AND DATE('2015-05-31')
        $res = $query->select('id', 'title', 'start', 'end', 'eventMemo as url', 'allDay')
        ->where('userId', $userId)
        ->whereRAW("start BETWEEN DATE('$start') AND DATE('$end')");
    
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
        	'createdBy'		=> $userId,
        	'updatedBy'		=> $userId,
            'dateCreated'	=> $now,
            'dateUpdated'	=> $now
        );
        
        $query->insert($dataForEvent);
    }
}
