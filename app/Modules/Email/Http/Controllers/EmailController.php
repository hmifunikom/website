<?php namespace HMIF\Modules\Email\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class EmailController extends Controller {
	
	public function index()
	{
		return view('email::index');
	}
	
}