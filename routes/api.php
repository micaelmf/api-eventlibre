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

/*
Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('event')->group(function(){
        Route::get('/', 'EventController@index')->name('events');
        Route::get('/{id}', 'EventController@show')->name('event');
    });
});
*/

Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('events')->group(function(){
        Route::get('/', 'EventController@index')->name('index_events');
        Route::get('/{id}', 'EventController@show')->name('single_event');
        Route::post('/', 'EventController@store')->name('store_event');
        Route::put('/{id}', 'EventController@update')->name('update_event');
        Route::delete('/{id}', 'EventController@destroy')->name('destroy_event');
    });
});

Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('users')->group(function(){
        Route::get('/', 'UserController@index')->name('index_users');
        Route::get('/{id}', 'UserController@show')->name('single_user');
        Route::post('/', 'UserController@store')->name('store_user');
        Route::put('/{id}', 'UserController@update')->name('update_user');
        Route::delete('/{id}', 'UserController@destroy')->name('destroy_user');
    });
});
