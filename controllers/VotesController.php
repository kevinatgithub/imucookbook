<?php

class VotesController extends \BaseController {

	function get_of($id){
		return Vote::with('user')->whereNoteId($id)->get();
	}

}