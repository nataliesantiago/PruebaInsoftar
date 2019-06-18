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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'cors'], function() {
    // Route::resource('user', 'UserController');
    Route::get('get-users', 'UserController@index');
    Route::post('create-user', 'UserController@store');
    Route::get('get-user/{id}', 'UserController@show');
    Route::post('edit-user/{id}', 'UserController@update');
});