<?php

Route::group(['namespace' => 'HMIF\\Modules\Keanggotaan\Http\Controllers'], function()
{
    Config::set('former.translate_from', 'keanggotaan::validation.attributes');

    route_prefix('keanggotaan', function() {
        Route::get('/', ['uses' => 'KeanggotaanController@index', 'as' => 'keanggotaan.index']);
    });
});

Route::group(['namespace' => 'HMIF\\Modules\Keanggotaan\Http\Controllers\Panel'], function()
{
    route_panel(function() {
        if(Request::is('panel/keanggotaan/*'))
        {
            route_bind_key('anggota', HMIF\Modules\Keanggotaan\Repositories\AnggotaRepository::class, 'nim');
        }

        Route::get('keanggotaan', ['as' => 'panel.keanggotaan.index', function() {
            return redirect()->route('panel.keanggotaan.anggota.index');
        }]);

        Route::resource('keanggotaan/anggota', 'AnggotaController', ['except' => ['create', 'store']]);
        Route::post('keanggotaan/anggota/{anggota}/avatar', ['uses' => 'AnggotaController@avatarStore', 'as' => 'panel.keanggotaan.avatar.store']);
    });
});