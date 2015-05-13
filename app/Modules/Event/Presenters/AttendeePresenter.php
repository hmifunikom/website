<?php namespace HMIF\Modules\Event\Presenters;

use HMIF\Modules\Event\Entities\Attendee;
use McCool\LaravelAutoPresenter\BasePresenter;

class AttendeePresenter extends BasePresenter {

    public function __construct(Attendee $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function kode()
    {
        return str_pad($this->wrappedObject->kode, 3, 0, STR_PAD_LEFT);
    }

}
