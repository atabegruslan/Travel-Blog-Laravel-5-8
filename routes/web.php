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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['namespace' => 'Web', 'middleware' => ['auth']], function () {

	Route::resource('/entry', 'EntryController');
	Route::resource('/region', 'RegionController');

	Route::resource('/user', 'UserController');
	Route::resource('/role', 'RoleController');

	Route::get('/search', 'SearchController@index');

    Route::get('/', 'PageController@welcome');
	Route::get('/android', 'PageController@android');
	Route::get('/contact', 'PageController@contact');

	Route::post('/email', 'EmailController@send');
	
	Route::get('/log', 'ActionLogController@index');
	Route::post('/log/restore', 'ActionLogController@restore');

});

Route::group(['namespace' => 'Web'], function () {

	Route::get('auth/{provider}', ['uses' => 'SocialController@redirectToProvider', 'as' => 'social.login']);
	Route::get('auth/{provider}/callback', 'SocialController@handleProviderCallback');

});

Route::post('/notification', 'NotificationController@store');
Route::post('/notification/firebase', 'NotificationController@firebaseStore');
Route::get('/markAsRead', 'NotificationController@markAsRead');
