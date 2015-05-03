<?php namespace HMIF\Modules\Keanggotaan\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class KeanggotaanController extends Controller {

	public function index()
	{
		return View::make('keanggotaan::index');
	}
	
}