<?php namespace HMIF\Modules\Keanggotaan\Presenters;

use HMIF\Modules\Keanggotaan\Entities\Divisi;
use McCool\LaravelAutoPresenter\BasePresenter;

class DivisiPresenter extends BasePresenter {

    public function __construct(Divisi $resource)
    {
        $this->wrappedObject = $resource;
    }

}
