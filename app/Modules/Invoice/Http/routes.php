<?php

Route::group(['prefix' => 'invoice', 'namespace' => 'HMIF\\Modules\Invoice\Http\Controllers'], function()
{
	Route::get('/', 'InvoiceController@index');
});

Route::group(['namespace' => 'HMIF\Modules\Invoice\Http\Controllers\Panel'], function()
{
	route_panel(function() {
		if(Request::is('panel/invoice/*'))
		{
			route_repo('invoice', HMIF\Modules\Invoice\Repositories\InvoiceRepository::class, null, 'invoice');
		}

		Route::resource('invoice', 'InvoiceController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
		Route::post('invoice/{invoice}/paid', ['uses' => 'InvoiceController@setPaidStatus', 'as' => 'panel.invoice.paid']);
	});
});