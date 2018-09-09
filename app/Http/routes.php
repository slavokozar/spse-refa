<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



    Route::get('/', function (){
        return redirect(action('TicketsController@index'));
    });

    Route::get('help', function(){
        return view('help');
    });

    // Authentication routes...
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');

    Route::get('password', 'Auth\PasswordController@getChange');
    Route::post('password', 'Auth\PasswordController@postChange');


    Route::get('import', 'Auth\UserController@import');

    Route::resource('support', 'TicketsController');

    Route::get('support/area/{area}','TicketsController@area');
    Route::get('support/{ticket}/status/{status}', 'TicketsController@editStatus');
    Route::put('support/{ticket}/status/{status}', 'TicketsController@putStatus');
    Route::get('support/{ticket}/history', 'TicketsController@history');



    Route::get('settings', 'SettingsController@index');
    Route::post('settings', 'SettingsController@store');



    Route::resource('areas', 'AreasController');
    Route::get('areas/{id}/delete', 'AreasController@delete');

    Route::resource('failures', 'FailuresController');
    Route::get('failures/{id}/delete', 'FailuresController@delete');

