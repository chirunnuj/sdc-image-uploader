<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/users/add', [
	'as'	=>	'user_add',
	'uses'	=>	'UserController@add']);
Route::get('/users/edit/{id}', [
	'as'	=>	'user_edit',
	'uses'	=>	'UserController@edit']);
Route::post('/users/update', 'UserController@update');
Route::get('/users/list', [
	'as'	=>	'users_list',
	'uses'	=>	'UserController@list']);
Route::post('/users/delete/{id}', 'UserController@delete');

Route::get('/upload', [
	'as'	=>	'upload_home',
	'uses'	=>	'UploadController@index']);
