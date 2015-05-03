<?php namespace HMIF\Modules\User\Presenters;

use HMIF\Modules\User\Entities\User;
use McCool\LaravelAutoPresenter\BasePresenter;

class UserPresenter extends BasePresenter {

    public function __construct(User $resource)
    {
        $this->wrappedObject = $resource;
    }



}
