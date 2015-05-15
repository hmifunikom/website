<?php namespace HMIF\Modules\Keanggotaan\Presenters;

use HMIF\Modules\Keanggotaan\Entities\Anggota;
use McCool\LaravelAutoPresenter\BasePresenter;

class AnggotaPresenter extends BasePresenter {

    public function __construct(Anggota $resource)
    {
        $this->wrappedObject = $resource;
    }

}
