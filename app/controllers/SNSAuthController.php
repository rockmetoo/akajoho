<?php

class SNSAuthController extends BaseController
{
	public function getFacebookToken()
	{
		$userId = Auth::user()->userId;
		
		$res = Sns::getCallbackUrlByUserId($userId)->get();
		
		if (count($res)) {
			Sns::saveCallbackUrl($userId, URL::previous());
		} else {
			Sns::insertCallbackUrl($userId, URL::previous());
		}
			
		$fb		= OAuth::consumer('Facebook', Request::root().'/fb/token/callback');
		$url	= $fb->getAuthorizationUri();
		
		// return to facebook login url
		return Redirect::to((string)$url);
	}

	public function getTwitterToken()
	{
		$userId = Auth::user()->userId;
		
		$res = Sns::getCallbackUrlByUserId($userId)->get();
		
		if (empty($res[0]->callback)) {
			Sns::insertCallbackUrl($userId, URL::previous());
		} else {
			Sns::saveCallbackUrl($userId, URL::previous());
		}
		
		$tw			= OAuth::consumer('Twitter', Request::root().'/tw/token/callback');
        $reqToken	= $tw->requestRequestToken();

        // get Authorization Uri sending the request token
        $url		= $tw->getAuthorizationUri(array('oauth_token' => $reqToken->getRequestToken()));

        // return to twitter login url
        return Redirect::to((string)$url);
	}
	
    public function getFacebookAuth()
    {
    	$userId = Auth::user()->userId;
    	
    	// get data from input
    	$code = Input::get( 'code' );
    	
    	// get fb service
    	$fb = OAuth::consumer('Facebook');

    	$res = Sns::getCallbackUrlByUserId($userId)->get();
    	
    	// if code is provided get user data and sign in
    	if (!empty($code)) {
    	
    		// This was a callback request from facebook, get the token
    		$token = $fb->requestAccessToken($code);
    	
    		$accessToken = $token->getAccessToken();

    		$result = json_decode($fb->request('/me'), true);
    	
    		Sns::saveFacebookAuthentication(
    			$userId, array('userid' => $result['id'], 'code' => $code, 'accessToken' => $accessToken)
    		);
    		
    		return Redirect::to((string)$res[0]->callback)->with('success', 'Facebook authentication has been successful');
    	}
    	
    	return Redirect::to((string)$res[0]->callback)->with('error', 'Error: Facebook authentication failed!');
    }

    public function getTwitterAuth()
    {
    }
}
