<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'WebZoom', 'prefix' => 'zoom', 'as' => 'zoom.'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'MeetingController@index']);
    Route::get('create-user', ['as' => 'create.user', 'uses' => 'MeetingController@createUser']);
    Route::post('create-user', ['as' => 'store.user', 'uses' => 'MeetingController@storeUser']);
    Route::get('users', ['as' => 'list.users', 'uses' => 'MeetingController@users']);

    Route::get('meetings', ['as' => 'list.meetings', 'uses' => 'MeetingController@meetings']);
    Route::get('create-meeting', ['as' => 'create.meeting', 'uses' => 'MeetingController@createMeeting']);
    Route::post('create-meeting', ['as' => 'store.meeting', 'uses' => 'MeetingController@storeMeeting']);
    Route::get('get-meeting/{id}', ['as' => 'get.meeting', 'uses' => 'MeetingController@getMeeting']);
    Route::get('end-meeting/{id}', ['as' => 'end.meeting', 'uses' => 'MeetingController@endMeeting']);
    Route::get('delete-meeting/{id}', ['as' => 'delete.meeting', 'uses' => 'MeetingController@deleteMeeting']);
});
