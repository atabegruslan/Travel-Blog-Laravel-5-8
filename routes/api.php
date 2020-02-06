<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Protected access to user's own info: GET api/user with access token
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected CRUDs
Route::group(['namespace' => 'Api', 'middleware' => ['auth:api']], function () {

	Route::resource('/entry', 'EntryController');

	Route::post('/user', 'UserController@store');

});

Route::group(['namespace' => 'Api'], function () {

	Route::resource('/region', 'RegionController');
	Route::post('/region/rearrange', 'RegionController@rearrange');

	Route::resource('/comment', 'CommentController');

	Route::get('autosuggest/user/{name}', 'UserController@autosuggest');

});