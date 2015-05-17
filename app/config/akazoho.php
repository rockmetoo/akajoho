<?php

	return [
	    'auth' => array(
	        'ttl' => 1800,
	    ),
	    'mail' => array(
	    	'contact' => 'akajoho@gmail.com',
	    	'noreply' => 'akajoho@gmail.com',
	    	'support' => 'akajoho@gmail.com'
	    ),
	    'whereToNotify' => array(
	    	'Mail'		=> 1,
	    	'Facebook'	=> 2,
	    	'Twitter'	=> 3
	    ),
	    'whenToNotify' => array(
	    	'1_day_b4'		=> 1,
    		'3_day_b4'		=> 2,
    		'7_day_b4'		=> 3,
    		'1_3_day_b4'	=> 4,
    		'1_7_day_b4'	=> 5,
    		'3_7_day_b4'	=> 6
	    )
	];
