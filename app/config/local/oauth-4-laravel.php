<?php

return array( 

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'redis', 

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => '694910567299102',
            'client_secret' => '1aa585b8921c158cee346dad2e70ed3f',
            'scope'         => array('email', 'read_friendlists'),
        ),      

    )

);