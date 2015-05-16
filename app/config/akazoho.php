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
	    'whichSNS' => array(
	    	'Facebook'	=> 1,
	    	'Twitter'	=> 2	
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
