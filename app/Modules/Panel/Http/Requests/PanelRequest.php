<?php namespace HMIF\Modules\Panel\Http\Requests;

use HMIF\Http\Requests\Request as FormRequest;

abstract class PanelRequest extends FormRequest {

    public function authorize()
    {
        return true;
    }

}
