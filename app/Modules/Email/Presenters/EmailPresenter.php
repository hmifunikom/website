<?php namespace HMIF\Modules\Email\Presenters;

use Date;
use HMIF\Modules\Email\Entities\Email;
use McCool\LaravelAutoPresenter\BasePresenter;

class EmailPresenter extends BasePresenter {

    public function __construct(Email $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function mulai_full()
    {
        return $this->wrappedObject->mulai->format('l, j F Y @ H:i');
    }

    public function mulai_tanggal()
    {
        return $this->wrappedObject->mulai->format('m/d/Y');
    }

    public function mulai_waktu()
    {
        return $this->wrappedObject->mulai->format('H:i');
    }

    public function open_register()
    {
        return $this->wrappedObject->mulai->gte(Date::now());
    }

}
