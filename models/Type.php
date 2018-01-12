<?php

class Type extends \Eloquent {
	protected $fillable = ['value','icon','color','user_id'];

	function user(){
		return $this->belongsTo("User",'user_id','user_id');
	}

	function notes(){
		return $this->hasMany("Note","type_id","id");
	}
}