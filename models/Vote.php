<?php

class Vote extends \Eloquent {
	protected $fillable = ["note_id","user_id"];

	function note(){
		return $this->belongsTo("note","note_id","id");
	}

	function user(){
		return $this->belongsTo("user","user_id","user_id");
	}
}