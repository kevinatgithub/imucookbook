<?php

class DashboardController extends \BaseController {

	function get_index(){
		
		return View::make('dashboard.index');
	}

	

}