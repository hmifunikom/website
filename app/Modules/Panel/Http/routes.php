<?php

Route::group(['namespace' => 'HMIF\\Modules\Panel\Http\Controllers'], function()
{
	route_panel(function() {
        Route::get('/', function () {
            return redirect()->route('panel.index');
        });

        Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'panel.index']);

        Route::get('setting', ['uses' => 'SettingController@edit', 'as' => 'panel.setting.edit']);
        Route::put('setting', ['uses' => 'SettingController@update', 'as' => 'panel.setting.update']);
        Route::post('setting/image', ['uses' => 'SettingController@updateImage', 'as' => 'panel.setting.update.image']);
    });
});

route_panel(function() {
    Route::get('logs', 'Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
