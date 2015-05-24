<?php namespace HMIF\Modules\User\Http\Requests;

use HMIF\Modules\Panel\Http\Requests\PanelRequest;

abstract class Request extends PanelRequest {

    public function authorize()
    {
        return true;
    }

}
