<?php namespace HMIF\Modules\Panel\Http\Controllers;

use HMIF\Http\Controllers\Controller;

class PanelController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
        head_norobot();
    }

}