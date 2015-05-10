<?php namespace HMIF\Modules\Email\Presenters;

use HMIF\Modules\Email\Entities\Attachment;
use McCool\LaravelAutoPresenter\BasePresenter;

class AttchmentPresenter extends BasePresenter {

    public function __construct(Attachment $resource)
    {
        $this->wrappedObject = $resource;
    }

}
