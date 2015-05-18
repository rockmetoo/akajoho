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
}
