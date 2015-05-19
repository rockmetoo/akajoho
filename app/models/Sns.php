<?php

class Sns extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table       = 'snsAuthentication';
    
    protected $primaryKey  = 'userId';

    /**
     * Stopping automatically inserting updated_at/created_at
     *
     * @var boolean
     */
    public $timestamps  = false;

    public function scopeGetSNSAuth($query, $userId)
    {
        $res = $query->select(array('facebook', 'twitter'))->where('userId', $userId);
    
        return $res;
    }

    public function scopeGetCallbackUrlByUserId($query, $userId)
    {
    	$res = $query->select(array('callback'))->where('userId', $userId);
    
    	return $res;
    }
    
    public function scopeInsertCallbackUrl($query, $userId, $callback)
    {
        $now = date('Y-m-d H:i:s');
        
        $dataForSnsAuthentication = array(
            'userId'		=> $userId,
        	'callback'		=> $callback,
        	'createdBy'		=> $userId,
        	'updatedBy'		=> $userId,
            'dateCreated'	=> $now,
            'dateUpdated'	=> $now
        );
        
        $query->insert($dataForSnsAuthentication);
    }
    
    public function scopeSaveCallbackUrl($query, $userId, $callback)
    {
    	$now = date('Y-m-d H:i:s');
    	
    	$dataForSnsAuthentication = array(
    		'callback'		=> $callback,
    		'updatedBy'		=> $userId,
    		'dateUpdated'	=> $now
    	);
    	
    	$query->where('userId', $userId)->update($dataForSnsAuthentication);
    }
    
    public function scopeSaveFacebookAuthentication($query, $userId, $data)
    {
    	$now = date('Y-m-d H:i:s');
    	 
    	$dataForSnsAuthentication = array(
    		'facebook'		=> json_encode($data),
    		'callback'		=> null,
    		'updatedBy'		=> $userId,
    		'dateUpdated'	=> $now
    	);
    	 
    	$query->where('userId', $userId)->update($dataForSnsAuthentication);
    }
}
