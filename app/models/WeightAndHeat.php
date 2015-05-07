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
    	->orderBy('when', 'DESC')
    	->take($entries);
    
    	return $res;
    }

    public function scopeGetLastFewEntriesForHeat($query, $userId, $entries = 12)
    {
    	$query    = DB::connection('akazoho')->table('heat');
    
    	$res      = $query->selectRaw("DATE_FORMAT(FROM_UNIXTIME(`when`), '%Y') AS year, DATE_FORMAT(FROM_UNIXTIME(`when`), '%m') AS month, DATE_FORMAT(FROM_UNIXTIME(`when`), '%d') AS day, heat")
    	->where('userId', $userId)
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
    
    public function scopeSaveWeight($query, $userId, $postData)
    {
        $now = date('Y-m-d H:i:s');
        
        $dataForWeight = array(
            'userId'    	=> $userId,
        	'weight'		=> $postData['weight'],
        	'when'			=> strtotime($postData['when']),
        	'createdBy'		=> $userId,
        	'updatedBy'		=> $userId,
            'dateCreated'	=> $now,
            'dateUpdated'	=> $now
        );
        
        $query->insert($dataForWeight);
    }
    
    public function scopeSaveHeat($query, $userId, $postData)
    {
    	$now	= date('Y-m-d H:i:s');
    	$query	= DB::connection('akazoho')->table('heat');
    	
        $dataForHeat = array(
            'userId'    	=> $userId,
        	'heat'			=> $postData['heat'],
        	'when'			=> strtotime($postData['when']),
        	'createdBy' 	=> $userId,
        	'updatedBy' 	=> $userId,
            'dateCreated' 	=> $now,
            'dateUpdated' 	=> $now
        );
        
        $query->insert($dataForHeat);
    }
}
