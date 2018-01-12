<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public $primaryKey = 'user_id';
	protected $hidden = ['password'];

	protected $fillable = [
		'user_id', 'password', 'fname', 'lname', 'dob', 'position'
	];

	function notes(){
		return $this->hasMany('note','user_id','user_id');
	}
}