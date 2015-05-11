<?php

class EmailSubscribeController extends BaseController
{
    public function getEmailSubscribe()
    {
        return View::make('emailsubscribe.index');
    }

    public function postEmailSubscribe()
    {
        // XXX: IMPORTANT - get all post data in one variable to reduce the call for Input::get
        $postData = Input::all();
        
        // validate the info, create rules for the inputs
        $rules = array(
            'email'   => 'required|email'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make($postData, $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            // send back the input so that we can repopulate the form
            return Redirect::to('/subscribe')->withErrors($validator);
        } else {
        	        	
        	$isMailExist = Subscribe::where('email', $postData['email'])->first();
        	
        	// XXX: IMPORTANT - if email already exist then skip saving the data again
        	if (is_null($isMailExist)) {
        		Subscribe::saveEmailSubscription($postData);
        	}
        	
        	return Redirect::to('/subscribe')->with('success', 'Your email address has been subscribed successfully');
        }
    }
}
