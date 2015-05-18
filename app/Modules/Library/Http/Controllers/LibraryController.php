<?php namespace HMIF\Modules\Library\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class LibraryController extends Controller {
	
	public function index()
	{
		return view('library::index');
	}
	
}