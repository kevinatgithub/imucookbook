<?php

class StepsController extends \BaseController {

	function get_ofnote($id){
        return Step::with("followers")->whereNoteId($id)->whereNull("lead_step")->orderBy('no')->get();
    }

    function get_oflead($id){
        return Step::with("followers")->whereLeadStep($id)->whereNull("lead_step")->orderBy('no')->get();
    }

}