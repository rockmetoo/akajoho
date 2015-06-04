<?php
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;

class IndexController extends BaseController
{
    public function getIndex()
    {
/*    	$credent = array(
    		'appId' => '695651673891658',
    		'secret' => '7c5c684c20e8081d058975015955acc4',
    	);
    	
    	FacebookSession::setDefaultApplication('695651673891658', '7c5c684c20e8081d058975015955acc4');
    	
    	$session	= new FacebookSession('CAAJ4sQbo40oBAO5XLQK6w1ZAqmqavJneHxmO9pxOUh5BEqvKVqwrC5bVQqTHuZAPCFBmZAh8tdCIaOhpXillhFuMsp4weXFLkzAdAOkOjYzdZCRnaZAY6ZAJwM0FewoZBCEIbAi7GWQjh3ZAchqkuh9AYge0DTNd9eYBBErEIlLhy1Ema8Wr8kub3dqvLw0MCkX9GZAnxkzSviZCBJEcKfZCosk');
    	
    	$data = array (
    		'message' => 'This is a test message',
    		'action_type' => 'SEND'
    	);
    	
    	$request	= new FacebookRequest($session, 'POST', '/10153185821667870/apprequests', $data);
    	$response	= $request->execute();
    	
    	$graphObject = $response->getGraphObject();
    	
    	var_dump($response);
    	
    	dd($graphObject);
    	
    	exit;
    	
    	//$facebook = new Facebook($credent);
*/    	
        if (!Auth::check()) {
            return View::make('index');
        }

        return Redirect::to('/dashboard');
    }
}
