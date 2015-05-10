<?php

Route::group(['prefix' => 'email', 'namespace' => 'HMIF\\Modules\Email\Http\Controllers'], function()
{
	Route::get('/', 'EmailController@index');
});