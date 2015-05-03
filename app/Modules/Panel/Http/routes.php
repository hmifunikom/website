<?php

Route::group(['namespace' => 'HMIF\\Modules\Panel\Http\Controllers'], function()
{
	route_panel(function() {
        Route::get('/', function () {
            return redirect()->route('panel.index');
        });

        Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'panel.index']);
        Route::get('dashboard2', ['uses' => 'DashboardController@index', 'as' => 'panel.index2']);
        Route::get('dashboard3', ['uses' => 'DashboardController@index', 'as' => 'panel.index3']);
    });
});

route_panel(function() {
    Route::get('logs', 'Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
