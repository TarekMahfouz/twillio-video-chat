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

Route::middleware('auth:api')->get('/twillio', function (Request $request) {
    return $request->user();
});

Route::get('access_token', 'API\AccessTokenController@generate_token');

Route::prefix('room')->middleware('auth')->group(function() {
    Route::get('join/{roomName}', 'VideoRoomsController@joinRoom');
    Route::post('create', 'VideoRoomsController@createRoom');
});
