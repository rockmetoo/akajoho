<?php

class SearchController extends BaseController
{
    public function postSearch()
    {
		return View::make('search.index');
    }
}
