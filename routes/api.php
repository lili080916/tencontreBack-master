<?php
# @Author: Codeals
# @Date:   20-04-2020
# @Email:  ian@codeals.es
# @Last modified by:   alejandro
# @Last modified time: 2020-04-22T01:26:20+01:00
# @Copyright: Codeals

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

Route::get('test', function () {
    return response([1,2,3], 200);
});

Route::get('test-redis', 'FoundController@testRedist');

//Route::post('found-add', 'FoundController@saveAddFound');

Route::post('forgot-password', 'UserController@forgotPassword');
Route::post('reset-password', 'UserController@resetPassword');
Route::post('user-register', 'UserController@registerPassword');
Route::post('user-register-social', 'UserController@registerSocial');
Route::post('user-active', 'UserController@activeUser');

Route::get('products-list/{secretUpdate}', 'ProductController@allProduct');
Route::get('location-list', 'LocationController@allLocation');
Route::get('allow-access/{secretUpdate}', 'UserController@allowAccess');

Route::middleware('auth:api')->get('/user', function (Request $request) {
	if ($request->user()->status == 1) {
		return $request->user();
	}

	return response(['data' => 'User is not activated :('], 404);
	//return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::post('change-password', 'UserController@changePasswordApi');

    /*found url*/
    Route::get('found-list', 'FoundController@getFoundList');
    Route::get('found-all', 'FoundController@getFoundAll');
    Route::post('found-search', 'FoundController@getFoundSearch');
    Route::post('found-search-list', 'FoundController@getFoundSearchList');
    Route::post('found-location', 'FoundController@getFoundByLocation');
    Route::post('found-location-distance', 'FoundController@getFoundByLocationDistance');
    Route::post('found-delete-location', 'FoundController@deleteFoundByLocation');
    Route::post('found-get', 'FoundController@getFoundById');
    Route::post('found-add', 'FoundController@saveAddFound');
    Route::put('found-update', 'FoundController@saveUpdateFound');
    Route::post('found-delete', 'FoundController@deleteFound');

    /*favorite url*/
    Route::get('favorite-list', 'FavoriteController@getFavoriteList');
    Route::post('favorite-get', 'FavoriteController@getFavoriteById');
    Route::post('favorite-add', 'FavoriteController@saveAddFavorite');
    Route::post('favorite-delete', 'FavoriteController@deleteFavorite');

    /*contact url*/
    Route::post('contact-send', 'ContactController@contactReport');

    /*Chat urls*/
    Route::post('get-user-conversation', 'ChatController@getUserConversationById');
    Route::post('save-chat', 'ChatController@saveUserChat');
    Route::post('get-chat-notifications', 'ChatController@getUserNotificationsChat');
    Route::post('clear-chat-notifications', 'ChatController@clearNotificationChat');

});
