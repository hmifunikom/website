<?php

Route::group(['namespace' => 'HMIF\Modules\Event\Http\Controllers'], function()
{
    Config::set('former.translate_from', 'event::validation.attributes');

    route_prefix('event', function() {
        Route::bind('event', function($value)
        {
            return Hashids::decode($value)[0];
        });

        Route::get('/', ['uses' => 'EventController@index', 'as' => 'event.index']);
        Route::get('{event}/{slug?}', ['uses' => 'EventController@show', 'as' => 'event.show']);
        Route::post('{event}/{slug?}', ['uses' => 'EventController@store', 'as' => 'event.store']);
    });
});

Route::group(['namespace' => 'HMIF\Modules\Event\Http\Controllers\Panel'], function()
{
    route_panel(function() {
        if(Request::is('panel/event/*'))
        {
            route_repo('event', HMIF\Modules\Event\Repositories\EventRepository::class, null, true);
            route_repo('ticket', HMIF\Modules\Event\Repositories\TicketRepository::class, null, 'event');
            route_repo('attendee', HMIF\Modules\Event\Repositories\AttendeeRepository::class, null, 'ticket');
        }

        Route::resource('event', 'EventController');
        Route::post('event/{event}/poster', ['uses' => 'EventController@posterStore', 'as' => 'panel.event.poster.store']);
        Route::delete('event/{event}/poster', ['uses' => 'EventController@posterDelete', 'as' => 'panel.event.poster.destroy']);

        Route::resource('event.ticket', 'TicketController', ['except' => ['show']]);
        Route::post('event/{event}/ticket/{ticket}/status', ['uses' => 'TicketController@setStatus', 'as' => 'panel.event.ticket.status']);

        Route::resource('event.attendee', 'AttendeeController', ['except' => []]);
        Route::post('event/{event}/attendee/{attendee}/paid', ['uses' => 'AttendeeController@setPaidStatus', 'as' => 'panel.event.attendee.paid']);
    });
});