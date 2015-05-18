<?php

Route::group(['prefix' => 'library', 'namespace' => 'HMIF\\Modules\Library\Http\Controllers'], function()
{
	Route::get('/', 'LibraryController@index');
});