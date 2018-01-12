<?php

class TypesController extends \BaseController {

	function get_index(){
		return View::make('types.index');
	}

	function get_list(){
		return Type::whereUserId(Auth::user()->user_id)->get();
	}

	function get_all(){
		return Type::with('user')->get();
	}

	function get_own(){
		return Type::with('user')->whereUserId(Auth::user()->user_id)->get();
	}

	function get_others(){
		return Type::with('user')->where('user_id','!=',Auth::user()->user_id)->get();
	}
	
	function post_new(){
		$value = Input::get('value');
		$icon = Input::get('icon');
		$color = Input::get('color');

		$type = new Type;
		$type->value = $value;
		$type->icon = $icon;
		$type->color = $color;
		$type->user_id = Auth::user()->user_id;
		$type->save();

		return $type;
	}

	function post_update(){
		$value = Input::get('value');
		$icon = Input::get('icon');
		$color = Input::get('color');

		$type = Type::find(Input::get('id'));
		$type->value = $value;
		$type->icon = $icon;
		$type->color = $color;
		$type->save();
	}

	function post_delete(){
		$t = Input::get("type");
		$type = Type::find($t['id']);

		if($type->notes->count()){
			self::moveNotesToTrash($type);
		}

		$type->delete();
	}

	static function moveNotesToTrash($type){
		$trashBin = Type::whereValue($type->user_id." Trash")->first();
		if($trashBin){
			foreach($type->notes as $note){
				$note->type_id = $trashBin->id;
				$note->save();
			}
		}else{
			self::makeTrashBin($type);
		}
	}

	static function makeTrashBin($type){
		$trashBin = new Type;
		$trashBin->value = $type->user_id." Trash";
		$trashBin->icon = "trash";
		$trashBin->color = "#000";
		$trashBin->user_id = $type->user_id;
		$trashBin->save();
		self::moveNotesToTrash($type);
	}
}