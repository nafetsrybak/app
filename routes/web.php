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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/admin', [
	'as' => 'admin',
	'uses' => 'AdminController@index'
]);
Route::post('comment/reply', [
	'as'=>'create.reply',
	'uses'=>'CommentRepliesController@createReply'
]);
Route::get('/post/{id}', [
	'as'=>'home.post',
	'uses'=>'HomeController@post'
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
