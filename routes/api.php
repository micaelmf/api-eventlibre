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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('events')->group(function(){
        Route::get('/', 'EventController@index')->name('index_events');
        Route::get('/{id}', 'EventController@show')->name('single_event');
        Route::get('/{id}/sponsors', 'EventController@allSponsorsOfEvent')->name('event_all_sponsors');
        Route::get('/{event_id}/sponsors/{sponsor_id}', 'EventController@singleSponsorOfEvent')->name('event_single_sponsor');
        Route::post('/', 'EventController@store')->name('store_event');
        Route::put('/{id}', 'EventController@update')->name('update_event');
        Route::delete('/{id}', 'EventController@destroy')->name('destroy_event');
    });
});

Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('addresses')->group(function(){
        Route::get('/', 'AddressController@index')->name('index_Addresses');
        Route::get('/{id}', 'AddressController@show')->name('single_Address');
        Route::post('/', 'AddressController@store')->name('store_Address');
        Route::put('/{id}', 'AddressController@update')->name('update_Address');
        Route::delete('/{id}', 'AddressController@destroy')->name('destroy_Address');
    });
});

Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('users')->group(function(){
        Route::get('/', 'UserController@index')->name('index_users');
        Route::get('/{id}', 'UserController@show')->name('single_user');
        Route::get('/{id}/events', 'UserController@allEventsOfUser')->name('user_events');
        Route::get('/{user_id}/events/{event_id}', 'UserController@singleEventOfUser')->name('user_events_single');
        Route::post('/', 'UserController@store')->name('store_user');
        Route::put('/{id}', 'UserController@update')->name('update_user');
        Route::delete('/{id}', 'UserController@destroy')->name('destroy_user');
    });
});

Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('activities')->group(function(){
        Route::get('/', 'ActivityController@index')->name('index_Activities');
        Route::get('/{id}', 'ActivityController@show')->name('single_Activity');
        Route::post('/', 'ActivityController@store')->name('store_Activity');
        Route::put('/{id}', 'ActivityController@update')->name('update_Activity');
        Route::delete('/{id}', 'ActivityController@destroy')->name('destroy_Activity');
    });
});

Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('speakers')->group(function(){
        Route::get('/', 'SpeakerController@index')->name('index_Speakers');
        Route::get('/{id}', 'SpeakerController@show')->name('single_Speaker');
        Route::post('/', 'SpeakerController@store')->name('store_Speaker');
        Route::put('/{id}', 'SpeakerController@update')->name('update_Speaker');
        Route::delete('/{id}', 'SpeakerController@destroy')->name('destroy_Speaker');
    });
});

Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('participants')->group(function(){
        Route::get('/', 'ParticipantController@index')->name('index_Participants');
        Route::get('/{id}', 'ParticipantController@show')->name('single_Participant');
        Route::post('/', 'ParticipantController@store')->name('store_Participant');
        Route::put('/{id}', 'ParticipantController@update')->name('update_Participant');
        Route::delete('/{id}', 'ParticipantController@destroy')->name('destroy_Participant');
    });
});

Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('sponsors')->group(function(){
        Route::get('/', 'SponsorController@index')->name('index_Sponsors');
        Route::get('/{id}', 'SponsorController@show')->name('single_Sponsor');
        Route::post('/', 'SponsorController@store')->name('store_Sponsor');
        Route::put('/{id}', 'SponsorController@update')->name('update_Sponsor');
        Route::delete('/{id}', 'SponsorController@destroy')->name('destroy_Sponsor');
    });
});