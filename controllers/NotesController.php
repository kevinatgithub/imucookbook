<?php

class NotesController extends \BaseController {

	function get_index(){
		return View::make('notes.index');
	}

	function get_otherworkof($user_id){
		return Note::select('id','title')->whereUserId($user_id)->get();
	}

	function get_by($user_id){
		return Note::with('type.user','author')->whereUserId($user_id)->get();
	}

	function get_typecounter(){
		$id = Input::get('id');
		return Note::whereTypeId($id)->count();
	}

	function get_bytype(){
		$id = Input::get('type');
		return Note::with('author','type')->whereTypeId($id)->get();
	}

	function get_search(){
		$keywords = Input::get('keywords');

		return Note::with('type.user','author')->whereRaw("MATCH(title,tags) AGAINST('$keywords*' IN BOOLEAN MODE)")->get();
	}

	function get_details($id){
		return Note::with('author','type','votes','steps')->find($id);
	}

	function post_vote(){
		$id = Input::get('note_id');
		$user = Input::get('user_id');

		Vote::insert([
			'note_id' => $id, 'user_id' => $user
		]);

		return Vote::whereNoteId($id)->get();
	}

	function get_top(){
		$notes = Note::with('type.user','author','votes')
				->selectRaw('*,(SELECT count(*) FROM votes WHERE note_id = notes.id ) as `votescount`')
				->orderBy('votescount','desc')->get()->take(10);
		
		return $notes->filter(function($note){
			return $note->votescount > 0;
		});
	}

	function post_create(){
		$note = new Note;
		$note->user_id = Auth::user()->user_id;
		$note->type_id = Input::get('type');
		$note->title = Input::get('title');
		$note->description = Input::get('description');
		$note->tags = Input::get('tags');
		$note->save();
		return $note;
	}

	function get_votescount($note_id){
		$note = Note::with('votes')->find($note_id);
		return $note->votes->count();
	}

	function post_delete(){
		$n = Input::get("note");
		$note = Note::with('votes','comments','steps')->find($n['id']);
		
		// foreach($note->votes as $vote){
		// 	$vote->delete();
		// }

		// foreach($note->comments as $comment){
		// 	$comment->delete();
		// }

		// foreach($note->steps as $step){
		// 	$step->delete();
		// }

		$note->delete();
	}

}