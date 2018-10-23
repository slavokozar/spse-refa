<?php

Route::get('/', function () {
    return redirect(action('Tickets\TicketController@index'));
});

// Auth

    Auth::routes();


// Help

    Route::get(trans('routes.help'), 'HelpController@index');


// Tickets

    Route::get(trans('routes.tickets.index'), 'Tickets\TicketController@index');
    Route::get(trans('routes.tickets.create'), 'Tickets\TicketController@create');
    Route::post(trans('routes.tickets.store'), 'Tickets\TicketController@store');
    Route::get(trans('routes.tickets.show'), 'Tickets\TicketController@show');



// Management

    Route::get(trans('routes.management.index'), 'Management\TicketController@index');
    Route::get(trans('routes.management.show'), 'Management\TicketController@show');
    Route::get(trans('routes.management.status'), 'Management\StatusController@create');
    Route::post(trans('routes.management.status'), 'Management\StatusController@store');



//  Settings

    Route::get('stats/users', 'StatsController@users');


    Route::get(trans('routes.settings.index'), 'Settings\SettingsController@index');

    Route::get(trans('routes.settings.managers.index'), 'Settings\ManagersController@index');
    Route::post(trans('routes.settings.managers.store'), 'Settings\ManagersController@store');

    Route::get(trans('routes.settings.areas.index'), 'Settings\AreaController@index');
    Route::get(trans('routes.settings.areas.create'), 'Settings\AreaController@create');
    Route::post(trans('routes.settings.areas.store'), 'Settings\AreaController@store');
    Route::post(trans('routes.settings.areas.show'), 'Settings\AreaController@show');
    Route::get(trans('routes.settings.areas.edit'), 'Settings\AreaController@edit');
    Route::put(trans('routes.settings.areas.update'), 'Settings\AreaController@update');
    Route::get(trans('routes.settings.areas.delete'), 'Settings\AreaController@delete');
    Route::delete(trans('routes.settings.areas.destroy'), 'Settings\AreaController@destroy');

    Route::get(trans('routes.settings.failures.index'), 'Settings\FailureController@index');
    Route::get(trans('routes.settings.failures.create'), 'Settings\FailureController@create');
    Route::post(trans('routes.settings.failures.store'), 'Settings\FailureController@store');
    Route::post(trans('routes.settings.failures.show'), 'Settings\FailureController@show');
    Route::get(trans('routes.settings.failures.edit'), 'Settings\FailureController@edit');
    Route::put(trans('routes.settings.failures.update'), 'Settings\FailureController@update');
    Route::get(trans('routes.settings.failures.delete'), 'Settings\FailureController@delete');
    Route::delete(trans('routes.settings.failures.destroy'), 'Settings\FailureController@destroy');


