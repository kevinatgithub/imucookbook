<?php

class Comment extends \Eloquent {
	protected $fillable = ['note_id','content','user_id'];

	function user(){
		return $this->belongsTo('user','user_id','user_id');
	}
}