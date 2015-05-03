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
        return 'Rp. ' . number_format($this->wrappedObject->harga, 0, ',', '.');
    }

}
