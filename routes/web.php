<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index');

Route::get('/admin', [
	'middleware'=>['auth', 'admin'],
	'as' => 'admin',
	function(){
		return view('admin.index');
	}
]);
Route::post('comment/reply', [
	'as'=>'create.reply',
	'uses'=>'CommentRepliesController@createReply',
	'middleware'=>'auth'
]);
Route::get('/post/{id}', [
	'as'=>'home.post',
	'uses'=>'AdminPostsController@post'
]);
Route::delete('admin/delete/media', [
	'as'=>'delete.media',
	'uses'=>'AdminMediasController@deleteMedia'
]);

Route::resource('/admin/users', 'AdminUsersController');
Route::resource('/admin/posts', 'AdminPostsController');
Route::resource('/admin/categories', 'AdminCategoryController');
Route::resource('/admin/media', 'AdminMediasController');
Route::resource('/admin/comments', 'PostCommentsController');
Route::resource('/admin/comment/replies', 'CommentRepliesController');

Route::get('/phpinfo', function(){
	phpinfo();
});

Route::get('/script', function(){
	var_dump(get_html_translation_table(ENT_HTML5));
	// echo htmlentities('script');
});
