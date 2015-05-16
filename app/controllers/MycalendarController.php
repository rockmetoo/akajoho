<?php

class MycalendarController extends BaseController
{
    public function getIndex()
    {
		return View::make('mycalendar.index');
    }
}
