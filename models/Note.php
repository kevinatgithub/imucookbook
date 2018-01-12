<?php

class Note extends \Eloquent {
	protected $fillable = [
		'type_id','user_id','title','description','tags'
	];

	function author(){
		return $this->belongsTo("User","user_id","user_id");
	}

	function type(){
		return $this->belongsTo("Type","type_id","id");
	}

	function comments(){
		return $this->hasMany("Comment","note_id","id");
	}

	function votes(){
		return $this->hasMany("Vote","note_id","id");
	}

	function steps(){
		return $this->belongsTo("Step","id","note_id");
	}
}