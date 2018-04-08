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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user( );
// });
// Route::get('user',['as' => 'user', 'uses' =>'Auth\LoginController@getUsers'])
Route::group([
    'middleware'=>'api',
    'prefix'=>'auth',
], function(){
    
    Route::post('/register','AuthController@register');
    Route::post('/login','AuthController@login');
    Route::post('/me','AuthController@me');
    
});

Route::get('/user/friends','UserController@friends');
Route::post('/user/{user_id}/add_friend','UserController@addFriend');
Route::post('/user/{user_id}/remove_friend','UserController@removeFriend');

Route::apiResource('post','PostController');
Route::apiResource('user','UserController');