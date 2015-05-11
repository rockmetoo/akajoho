<?php

class PrivacyController extends BaseController
{
    public function getPrivacy()
    {
		return View::make('privacy.index');
    }
}
