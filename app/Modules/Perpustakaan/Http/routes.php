<?php

Route::group(['prefix' => 'perpustakaan', 'namespace' => 'HMIF\\Modules\Perpustakaan\Http\Controllers'], function()
{
	Route::get('/', 'PerpustakaanController@index');
});