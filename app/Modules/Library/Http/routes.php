<?php

Route::group(['namespace' => 'HMIF\\Modules\Library\Http\Controllers'], function()
{
    route_prefix('library', function() {
        Route::get('/', ['uses' => 'BookController@index', 'as' => 'library.index']);
    });
});

Route::group(['namespace' => 'HMIF\\Modules\Library\Http\Controllers\Panel'], function()
{
    route_panel(function() {
        Route::get('library', ['uses' => 'BookController@index', 'as' => 'panel.library.index']);
    });
});