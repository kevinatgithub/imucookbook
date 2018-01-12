<?php

class HomeController extends \BaseController {

	function login(){
		return View::make('home.login');
	}

	function processlogin(){
		$creds = [
			'user_id' => Input::get('user_id'),	'password' => Input::get('password')
		];

		if(Auth::attempt($creds)){
			return Redirect::to('dashboard');
		}

		return Redirect::back()->withMessage([
			'content' => 'Login Failed!',	'type' => 'danger'
		]);
	}

	function logout(){
		Auth::logout();
		return Redirect::to('/')->withMessage([
			'content' => 'Succefully Logout!', 'type' => 'info'
		]);
	}

}