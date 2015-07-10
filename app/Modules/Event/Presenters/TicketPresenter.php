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
        if($this->wrappedObject->harga == 0)
        {
            return 'Free';
        }
        else
        {
            return 'Rp. ' . number_format($this->wrappedObject->harga, 0, ',', '.');
        }
    }

    public function id_hash()
    {
        return $this->wrappedObject->getRouteKey();
    }

    public function sisa_kuota()
    {
        return $this->wrappedObject->kuota - $this->wrappedObject->terjual;
    }

    public function nama_tiket_full()
    {
        return $this->wrappedObject->nama_tiket . ' (' . $this->harga_rp() . ') Kuota tersisa: ' . $this->sisa_kuota();
    }
}
