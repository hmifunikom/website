<?php namespace HMIF\Modules\Email\Presenters;

use Date;
use HMIF\Modules\Email\Entities\Email;
use McCool\LaravelAutoPresenter\BasePresenter;

class EmailPresenter extends BasePresenter {

    public function __construct(Email $resource)
    {
        $this->wrappedObject = $resource;
    }



}
