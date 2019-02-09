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



Route::auth();


/*
*Dashboard
*/
Route::get('/',['uses' => 'PagesController@getIndex'])->name('home');

Route::get('/grupo/{group}',['uses' => 'FileController@getFiles'])->name('files.showFile');

Route::get('/searchConts', function (Request $request) {
    return view('mobile.searchConts');
    
});

/*****************************************************/

Route::get('/groups/{id?}',['uses' => 'FileController@index']);

Route::get('/searchConts/{id}/{value}/{profile?}',['uses' => 'SearchController@searchConts']);
Route::get('/searchUsers/{value?}',['uses' => 'SearchController@searchUsers']);

Route::get('/notificationUsers',['uses' => 'NotificationUsersController@index'])->name('NotificationUsers.index');

/*****************************************************/

/*
*Profile
*/
Route::get('/{id}',['uses' => 'PagesController@getProfile']);
Route::get('/{id?}/grupo/{group}/{id_file?}',['uses' => 'FileController@getFilesProfile'])->name('files.showFile');
Route::get('/{id}/seguindo',['uses' => 'FollowingController@index']);
Route::get('/{id}/seguidores',['uses' => 'FollowerController@index']);

Route::resource('files', 'FileController');
Route::resource('users', 'UserController');
Route::resource('followings', 'FollowingController');
Route::resource('followers', 'FollowerController');

Route::post('/fetch',['uses' => 'FetchUrlController@fetch']);
