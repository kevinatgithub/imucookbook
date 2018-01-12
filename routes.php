<?php



route::controller('notes','NotesController');
route::get('login','HomeController@login');
route::get('/','HomeController@login');
route::post('login','HomeController@processlogin');
route::post('/','HomeController@processlogin');
route::get('logout','HomeController@logout');

route::group(['before' => 'CheckAccess'],function(){
    route::controller('dashboard','DashboardController');
    route::controller('types','TypesController');
    route::controller('comments','CommentsController');
    route::controller('votes','VotesController');
    route::controller('steps','StepsController');
    route::get('vue',function(){
        return View::make('vue');
    });
});

route::filter('CheckAccess',function(){
    if(Auth::guest()){
        return Redirect::to('login');
    }
});