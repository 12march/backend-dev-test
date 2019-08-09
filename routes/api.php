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

// JWT authentication
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::post('groups', 'GroupController@store');
Route::get('groups/public', 'GroupController@index');
Route::get('groups/{id}/members', 'GroupController@show');

Route::post('groups/invite', 'InviteController@process');
Route::get('accept/{token}', 'InviteController@accept')->name('accept');
