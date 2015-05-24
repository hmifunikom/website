<?php namespace HMIF\Modules\User\Presenters;

use HMIF\Modules\User\Entities\User;
use McCool\LaravelAutoPresenter\BasePresenter;

class UserPresenter extends BasePresenter {

    public function __construct(User $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function dibuat()
    {
        return $this->wrappedObject->created_at->format('l, j F Y @ H:i');
    }


}
