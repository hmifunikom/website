<?php namespace HMIF\Modules\Event\Presenters;

use HMIF\Modules\Event\Entities\Ticket;
use McCool\LaravelAutoPresenter\BasePresenter;

class TicketPresenter extends BasePresenter {

    public function __construct(Ticket $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function harga_rp()
    {
        return 'Rp. ' . number_format($this->wrappedObject->harga, 0, ',', '.');
    }

    public function id_hash()
    {
        return $this->wrappedObject->getRouteKey();
    }
}
