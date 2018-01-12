<?php

class CommentsController extends \BaseController {

	function get_of($id){
		return Comment::with('user')->whereNoteId($id)->get();
	}

	function get_by($id){
		return Comment::with('user')->whereUserId($id)->get();
	}

	function post_new(){
		$id = Input::get('note_id');
		$user_id = Input::get('user_id');
		$content = Input::get('content');

		$c = new Comment;
		$c->note_id = $id;
		$c->user_id = $user_id;
		$c->content = $content;
		$c->save();

		return $this->get_of($id);
	}

}