<?php namespace HMIF\Modules\Invoice\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class InvoiceController extends Controller {
	
	public function index()
	{
		return view('invoice::index');
	}
	
}