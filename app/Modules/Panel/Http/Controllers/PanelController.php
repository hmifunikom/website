<?php namespace HMIF\Modules\Panel\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class PanelController extends Controller {

	public function index()
	{
		return View::make('panel::index');
	}
	
}