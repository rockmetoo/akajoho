<?php

class SNSAuthController extends BaseController
{
	public function getFacebookToken()
	{
		$fb		= OAuth::consumer('Facebook', 'place write callback URL');
		$url	= $fb->getAuthorizationUri();
		
		// return to facebook login url
		return Redirect::to((string)$url);
	}

	public function getTwitterToken()
	{
		$tw			= OAuth::consumer('Twitter', 'place write callback URL');
        $reqToken	= $tw->requestRequestToken();

        // get Authorization Uri sending the request token
        $url		= $tw->getAuthorizationUri(array('oauth_token' => $reqToken->getRequestToken()));

        // return to twitter login url
        return Redirect::to((string)$url);
	}
	
    public function getFacebookAuth()
    {
    }

    public function getTwitterAuth()
    {
    }
}
