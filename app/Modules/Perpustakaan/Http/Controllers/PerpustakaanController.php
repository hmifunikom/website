<?php namespace HMIF\Modules\Perpustakaan\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class PerpustakaanController extends Controller {

	public function index()
	{
		return View::make('perpustakaan::index');
	}
	
}