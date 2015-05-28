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
    'storage' => 'Session', 

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => '695651673891658',
            'client_secret' => '7c5c684c20e8081d058975015955acc4',
            'scope'         => array('email', 'publish_actions'),
        ),      

    )

);