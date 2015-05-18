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

    public function nim()
    {
        return ($this->wrappedObject->nim) ?: '-';
    }

    public function tanggal_daftar()
    {
        return $this->wrappedObject->created_at->format('l, j F Y');
    }

    public function tiket()
    {
        return $this->wrappedObject->id_tiket;
    }

    public function dibayar()
    {
        $invoice =  $this->wrappedObject->invoice()->first();
        return $invoice['dibayar'];
    }

}
