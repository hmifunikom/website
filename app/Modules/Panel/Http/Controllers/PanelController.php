<?php namespace HMIF\Modules\Panel\Http\Controllers;

use HMIF\Http\Controllers\Controller;

class PanelController extends Controller {

    public function __construct()
    {
        head_norobot();
    }

}