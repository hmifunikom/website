<?php

Route::group(['namespace' => 'HMIF\\Modules\Panel\Http\Controllers'], function()
{
	route_panel(function() {
        Route::get('/', function () {
            return redirect()->route('panel.index');
        });

        Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'panel.index']);
    });
});

route_panel(function() {
    Route::get('logs', 'Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
