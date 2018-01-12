<?php

class Step extends \Eloquent {
	protected $fillable = [
		'note_id','no','lead_step','title','description','user_id'
	];

	function note(){
		return $this->belongsTo('Note','note_id','id');
	}

	function user(){
		return $this->belongsTo('User','user_id','user_id');
	}

	function lead(){
		return $this->belongsTo('Step','lead_step','id');
	}

	function followers(){
		return $this->hasMany('Step','lead_step','id');
	}
}