<?php

Route::group(['namespace' => 'HMIF\Modules\Event\Http\Controllers'], function()
{
    Former::setOption('translate_from', 'event::validation.attributes');

    route_prefix('event', function() {
        Route::bind('event', function($value)
        {
            return Hashids::decode($value)[0];
        });

        Route::get('/', ['uses' => 'EventController@index', 'as' => 'event.index']);
        Route::get('{event}/{slug?}', ['uses' => 'EventController@show', 'as' => 'event.show']);
        Route::get('{event}/{slug?}/book', ['uses' => 'EventBookController@create', 'as' => 'event.book.create']);
        //Route::post('{event}/book', ['uses' => 'EventBookController@store', 'as' => 'event.book.store']);
        //Route::get('{event}/book/{ticket}', ['uses' => 'EventBookController@show', 'as' => 'event.book.show']);
        //Route::get('{event}/book/{ticket}/download', ['uses' => 'EventBookController@download', 'as' => 'event.book.download']);
    });
});

Route::group(['namespace' => 'HMIF\Modules\Event\Http\Controllers\Panel'], function()
{
    route_panel(function() {
        if(Request::is('panel/event/*'))
        {
            route_repo('event', HMIF\Modules\Event\Repositories\EventRepository::class, null, true);
            route_repo('ticket', HMIF\Modules\Event\Repositories\TicketRepository::class, null, 'event');
        }

        Route::resource('event', 'EventController');
        Route::post('event/{event}/poster', ['uses' => 'EventController@posterStore', 'as' => 'panel.event.poster.store']);
        Route::delete('event/{event}/poster', ['uses' => 'EventController@posterDelete', 'as' => 'panel.event.poster.destroy']);

        Route::resource('event.ticket', 'TicketController', ['except' => ['show']]);
        Route::post('event/{event}/ticket/{ticket}/status', ['uses' => 'TicketController@setStatus', 'as' => 'panel.event.ticket.status']);
    });
});