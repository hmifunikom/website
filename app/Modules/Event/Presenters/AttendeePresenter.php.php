<?php namespace HMIF\Modules\Event\Presenters;

use HMIF\Modules\Event\Entities\Attendee;
use McCool\LaravelAutoPresenter\BasePresenter;

class AttendeePresenter extends BasePresenter {

    public function __construct(Attendee $resource)
    {
        $this->wrappedObject = $resource;
    }

}
