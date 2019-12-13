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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Web', 'middleware' => ['auth']], function () {

	Route::resource('/entry', 'EntryController');

	Route::get('/search', 'SearchController@index');

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

Route::get('/notification', 'NotificationController@index');
