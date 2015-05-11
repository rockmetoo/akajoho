<?php

class TermsController extends BaseController
{
    public function getTerms()
    {
		return View::make('terms.index');
    }
}
