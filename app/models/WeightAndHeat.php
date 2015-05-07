<?php

class WeightAndHeat extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table       = 'weight';
    
    protected $primaryKey  = 'userId';

    /**
     * Stopping automatically inserting updated_at/created_at
     *
     * @var boolean
     */
    public $timestamps  = false;

    public function scopeGetWeight($query, $userId)
    {
        $res = $query->select('*')->where('userId', $userId);
    
        return $res;
    }
    
    public function scopeGetHeat($query, $userId)
    {
    	$query	= DB::connection('akazoho')->table('heat');
    	$res	= $query->select('*')->where('userId', $userId);
    
    	return $res;
    }
    
    public function scopeGetLastFewEntriesForWeight($query, $userId, $entries = 12)
    {
    	$res      = $query->selectRaw("DATE_FORMAT(FROM_UNIXTIME(`when`), '%Y') AS year, DATE_FORMAT(FROM_UNIXTIME(`when`), '%m') AS month, DATE_FORMAT(FROM_UNIXTIME(`when`), '%d') AS day, weight")
    	->where('userId', $userId)
    	->groupBy('day')
    	->orderBy('when', 'DESC')
    	->take($entries);
    
    	return $res;
    }

    public function scopeGetLastFewEntriesForHeat($query, $userId, $entries = 12)
    {
    	$query    = DB::connection('akazoho')->table('heat');
    
    	$res      = $query->selectRaw("DATE_FORMAT(FROM_UNIXTIME(`when`), '%Y') AS year, DATE_FORMAT(FROM_UNIXTIME(`when`), '%m') AS month, DATE_FORMAT(FROM_UNIXTIME(`when`), '%d') AS day, heat")
    	->where('userId', $userId)
    	->groupBy('day')
    	->orderBy('when', 'DESC')
    	->take($entries);
    
    	return $res;
    }
    
    public function scopeGetTotalUrinationForToday($query, $userId)
    {
    	$query    = DB::connection('akazoho')->table('urination');
    
    	$res      = $query->selectRaw("COUNT(`when`) AS totalUrinationForToday")
    	->where('userId', $userId)->whereRaw('DATE(FROM_UNIXTIME(`when`)) = CURDATE()');
    
    	return $res;
    }
    
    public function scopeSaveFeeding($query, $userId, $postData)
    {
        $now = date('Y-m-d H:i:s');
        
        $dataForFeeding = array(
            'userId'    => $userId,
        	'diet'		=> $postData['diet'],
        	'quantity'	=> $postData['quantity'],
        	'when'		=> strtotime($postData['when']),
        	'createdBy' => $userId,
        	'updatedBy' => $userId,
            'dateCreated' => $now,
            'dateUpdated' => $now
        );
        
        $query->insert($dataForFeeding);
    }
    
    public function scopeSaveUrination($query, $userId, $postData)
    {
    	$now	= date('Y-m-d H:i:s');
    	$query	= DB::connection('akazoho')->table('urination');
    	
    	$dataForUrination = array(
    		'userId'    => $userId,
    		'color'		=> $postData['color'],
    		'when'		=> strtotime($postData['when']),
    		'createdBy' => $userId,
    		'updatedBy' => $userId,
    		'dateCreated' => $now,
    		'dateUpdated' => $now
    	);
    
    	$query->insert($dataForUrination);
    }
    
    public function scopeSavePoop($query, $userId, $postData)
    {
    	$now	= date('Y-m-d H:i:s');
    	$query	= DB::connection('akazoho')->table('poop');
    	 
    	$dataForPoop = array(
    		'userId'    => $userId,
    		'color'		=> $postData['color'],
    		'type'		=> $postData['type'],
    		'when'		=> strtotime($postData['when']),
    		'createdBy' => $userId,
    		'updatedBy' => $userId,
    		'dateCreated' => $now,
    		'dateUpdated' => $now
    	);
    
    	$query->insert($dataForPoop);
    }
}
