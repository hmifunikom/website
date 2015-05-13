<?php namespace HMIF\Modules\Invoice\Presenters;

use HMIF\Modules\Invoice\Entities\Invoice;
use McCool\LaravelAutoPresenter\BasePresenter;

class InvoicePresenter extends BasePresenter {

    public function __construct(Invoice $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function total_rp()
    {
        return to_rp($this->wrappedObject->jumlah);
    }

    public function tanggal_diterbitkan()
    {
        return $this->wrappedObject->created_at->format('l, j F Y');
    }

}
