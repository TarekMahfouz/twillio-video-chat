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

Route::group(['prefix' => 'twillio', 'as' => 'twillio.'], function() {
    Route::get('/', ['as' => 'login', 'uses' => 'TwillioController@authView']);
    Route::get('/register', ['as' => 'register.view', 'uses' => 'TwillioController@registerView']);

    Route::post('/login', ['as' => 'login.submit', 'uses' => 'TwillioController@submitLogin']);
    Route::post('/register', ['as' => 'register.submit', 'uses' => 'TwillioController@submitRegister']);

    Route::group(['middleware' => ['web']], function() {
        Route::get('/create-room', ['as' => 'create.room', 'uses' => 'TwillioController@createRoom']);
        Route::post('/create-room', ['as' => 'store.room', 'uses' => 'TwillioController@storeRoom']);

        Route::get('/room/{room_code}', ['as' => 'home', 'uses' => 'TwillioController@index']);

        Route::get('/logout', ['as' => 'logout', 'uses' => 'TwillioController@logout']);
    });
});


