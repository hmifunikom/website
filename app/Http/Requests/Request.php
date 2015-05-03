<?php namespace HMIF\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest {

	public function isUpdate() {
        return ($this->method() === static::METHOD_PUT || $this->method() === static::METHOD_PATCH);
    }

}
