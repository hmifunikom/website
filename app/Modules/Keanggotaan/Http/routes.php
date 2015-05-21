<?php

Route::group(['namespace' => 'HMIF\\Modules\Keanggotaan\Http\Controllers'], function()
{
    Former::setOption('translate_from', 'keanggotaan::validation.attributes');

    route_prefix('keanggotaan', function() {
        //Route::bind('event', function($value)
        //{
        //    return Hashids::decode($value)[0];
        //});
        //
        //Route::get('/', ['uses' => 'EventController@index', 'as' => 'event.index']);
        //Route::get('{event}/{slug?}', ['uses' => 'EventController@show', 'as' => 'event.show']);
        //Route::get('{event}/{slug?}/book', ['uses' => 'EventBookController@create', 'as' => 'event.book.create']);
        ////Route::post('{event}/book', ['uses' => 'EventBookController@store', 'as' => 'event.book.store']);
        ////Route::get('{event}/book/{ticket}', ['uses' => 'EventBookController@show', 'as' => 'event.book.show']);
        ////Route::get('{event}/book/{ticket}/download', ['uses' => 'EventBookController@download', 'as' => 'event.book.download']);
    });
});

Route::group(['namespace' => 'HMIF\\Modules\Keanggotaan\Http\Controllers\Panel'], function()
{
    route_panel(function() {
        if(Request::is('panel/keanggotaan/*'))
        {
            route_bind_key('anggota', HMIF\Modules\Keanggotaan\Repositories\AnggotaRepository::class, 'nim');
        }

        Route::resource('keanggotaan/anggota', 'AnggotaController');
    });
});