<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
*/

Route::get('/', ['uses' => 'projectManagerController@index']);
// API ROUTES 
Route::group(array('prefix' => 'api'), function() {
    Route::resource('/user', 'UserController');
});

// Route::group(['prefix' => 'api/1.0/project-manager'], function () {
//     Route::get('/', ['uses' => 'projectManagerController@index']);
// 	Route::get('list/{obj}', ['uses' => 'projectManagerController@getList']);
//     Route::get('item/{obj}/{id}', ['uses' => 'projectManagerController@getItem']);
// 	Route::post('item/delete', ['uses' => 'projectManagerController@deleteItem']);
//     Route::get('allnodes', ['uses' => 'projectManagerController@getAllNodes']);
// 	Route::get('alltreelevels', ['uses' => 'projectManagerController@getTreeLevels']);
// 	Route::get('allchildlevel/{id}', ['uses' => 'projectManagerController@getAllChildLevel']);
// 	Route::get('deleteleveltree/{parentid}', ['uses' => 'projectManagerController@deleleTreeLevels']);
	
// 	$childC = array('task','user','level');
// 	for($i=0; $i<count($childC); $i++) {
// 		Route::post('item/'.$childC[$i].'/new', ['uses' => 'projectManagerController@add'.$childC[$i]]);
// 		Route::post('item/'.$childC[$i].'/update', ['uses' => 'projectManagerController@update'.$childC[$i]]);
// 	}
// });

// Route::group(['prefix' => 'api/1.0/todo'], function () {
// 	Route::get('createform', ['as'=>'createform', 'uses' => 'toDoController@createForm']);
// 	Route::get('editform/{id}', ['as'=>'editform', 'uses' => 'toDoController@editForm']);
// 	Route::get('storeform', ['as'=>'storeform', 'uses' => 'toDoController@storeForm']);
// 	Route::get('todolist', ['uses' => 'toDoController@toDoList']);
// 	Route::get('findlist', ['uses' => 'toDoController@findList']);
// 	Route::get('todolist/all', ['uses' => 'toDoController@allTodoList']);
// 	Route::get('todolist/adduserprofile', ['uses' => 'toDoController@addUserProfile']);
// 	Route::get('todolist/removeuserprofile', ['uses' => 'toDoController@removeUserProfile']);
// 	Route::get('todolist/gettodolistbyitem', ['uses' => 'toDoController@getTodolistbyItem']);
// 	Route::get('todolist/createtodoitem', ['uses' => 'toDoController@createTodoitem']);
// 	Route::get('manymany', ['uses' => 'toDoController@manymany']);
// 	Route::get('manymanyrevert', ['uses' => 'toDoController@manymanyrevert']);
// 	Route::get('detachattachmanymany', ['uses' => 'toDoController@detachattachmanymany']);
// });