<?php

Route::group(['prefix' => 'invoice', 'namespace' => 'HMIF\\Modules\Invoice\Http\Controllers'], function()
{
	Route::get('/', 'InvoiceController@index');
});