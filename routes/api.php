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
Route::group([/*'prefix' => 'api', */'as' => 'api.', 'namespace' => 'Api', 'middleware' => ['auth:api']], function () {

	Route::resource('/entry', 'EntryController');
	Route::get('/entry-images', 'EntryController@images')->name('entry_images');

	Route::resource('/region', 'RegionController');
	Route::post('/region-rearrange', 'RegionController@rearrange')->name('region_rearrange');

	Route::resource('/user', 'UserController');
	Route::get('user-autosuggest/{name}', 'UserController@autosuggest')->name('user_autosuggest');

	Route::resource('/comment', 'CommentController');
});
