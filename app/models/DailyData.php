<?php

class DailyData extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table       = 'feeding';
    
    protected $primaryKey  = 'userId';

    /**
     * Stopping automatically inserting updated_at/created_at
     *
     * @var boolean
     */
    public $timestamps  = false;

    public function scopeGetFeeding($query, $userId)
    {
        $res = $query->select('*')->where('userId', $userId);
    
        return $res;
    }
    
    public function scopeGetLastSixFeedingEntryForToday($query, $userId)
    {
    	$query    = DB::connection('akazoho')->table('feeding');
    
    	$res      = $query->selectRaw("DATE_FORMAT(FROM_UNIXTIME(`when`), '%k') AS hour, DATE_FORMAT(FROM_UNIXTIME(`when`), '%i') AS minute, diet, quantity")
    	->where('userId', $userId)->whereRaw('DATE(FROM_UNIXTIME(`when`)) = CURDATE()')
    	->orderBy('when', 'DESC');
    
    	return $res;
    }
    
    public function scopeGetLastSixPoopEntryForToday($query, $userId)
    {
    	$query    = DB::connection('akazoho')->table('poop');
    
    	$res      = $query->selectRaw("DATE_FORMAT(FROM_UNIXTIME(`when`), '%k') AS hour, DATE_FORMAT(FROM_UNIXTIME(`when`), '%i') AS minute, color, type")
    	->where('userId', $userId)->whereRaw('DATE(FROM_UNIXTIME(`when`)) = CURDATE()')
    	->orderBy('when', 'DESC');
    
    	return $res;
    }
    
    public function scopeGetTotalPoopForToday($query, $userId)
    {
    	$query    = DB::connection('akazoho')->table('poop');
    
    	$res      = $query->selectRaw("COUNT(`when`) AS totalPoopForToday")
    	->where('userId', $userId)->whereRaw('DATE(FROM_UNIXTIME(`when`)) = CURDATE()');
    
    	return $res;
    }
    
    public function scopeGetLastSixDaysTotalPoop($query, $userId)
    {
    	$query    = DB::connection('akazoho')->table('poop');
    
    	$res      = $query->selectRaw("DATE_FORMAT(FROM_UNIXTIME(`when`), '%Y') AS year, DATE_FORMAT(FROM_UNIXTIME(`when`), '%m') AS month, DATE_FORMAT(FROM_UNIXTIME(`when`), '%d') AS day, COUNT(`when`) as totalPoop")
    	->where('userId', $userId)->whereRaw('`when` >= UNIX_TIMESTAMP(NOW() - INTERVAL 6 DAY)')
    	->groupBy('day')
    	->orderBy('when', 'DESC');
    
    	return $res;
    }

    public function scopeGetLastSixDaysTotalUrination($query, $userId)
    {
    	$query    = DB::connection('akazoho')->table('urination');
    
    	$res      = $query->selectRaw("DATE_FORMAT(FROM_UNIXTIME(`when`), '%Y') AS year, DATE_FORMAT(FROM_UNIXTIME(`when`), '%m') AS month, DATE_FORMAT(FROM_UNIXTIME(`when`), '%d') AS day, COUNT(`when`) as totalUrination")
    	->where('userId', $userId)->whereRaw('`when` >= UNIX_TIMESTAMP(NOW() - INTERVAL 6 DAY)')
    	->groupBy('day')
    	->orderBy('when', 'DESC');
    
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
    	$now		= date('Y-m-d H:i:s');
    	$strtotime	= strtotime($postData['when']);
    	$query		= DB::connection('akazoho')->table('poop');
    	 
    	$dataForPoop = array(
    		'userId'    => $userId,
    		'color'		=> $postData['color'],
    		'type'		=> $postData['type'],
    		'when'		=> $strtotime,
    		'createdBy' => $userId,
    		'updatedBy' => $userId,
    		'dateCreated' => $now,
    		'dateUpdated' => $now
    	);
    
    	$query->insert($dataForPoop);
    	
    	if (!empty($postData['includeUrination'])) {
    		$query	= DB::connection('akazoho')->table('urination');
    		 
    		$dataForUrination = array(
    			'userId'    => $userId,
    			'color'		=> Config::get('urination.colors')['1'],
    			'when'		=> $strtotime,
    			'createdBy' => $userId,
    			'updatedBy' => $userId,
    			'dateCreated' => $now,
    			'dateUpdated' => $now
    		);
    		
    		$query->insert($dataForUrination);
    	}
    }
}
