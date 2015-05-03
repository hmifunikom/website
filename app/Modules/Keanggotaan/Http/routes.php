<?php

Route::group(['prefix' => 'keanggotaan', 'namespace' => 'HMIF\\Modules\Keanggotaan\Http\Controllers'], function()
{
	Route::get('/', 'KeanggotaanController@index');
});