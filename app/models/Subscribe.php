<?php

class Subscribe extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table       = 'emailsubscribe';
    
    protected $primaryKey  = 'id';

    /**
     * Stopping automatically inserting updated_at/created_at
     *
     * @var boolean
     */
    public $timestamps  = false;

    public function scopeIsEmailExists($query, $email)
    {
        $res = $query->select('*')->where('email', $email);
    
        return $res;
    }
    
    public function scopeSaveEmailSubscription($query, $postdata)
    {
        $now = date('Y-m-d H:i:s');
        
        $dataForEmailSubscribe = array(
            'email'			=> $postdata['email'],
            'dateCreated'	=> $now,
            'dateUpdated'	=> $now
        );
        
        $query->insert($dataForEmailSubscribe);
    }
}
