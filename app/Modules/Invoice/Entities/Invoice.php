<?php namespace HMIF\Modules\Invoice\Entities;

use HMIF\Modules\Invoice\Presenters\InvoicePresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Invoice extends InvoiceRaw implements HasPresenter {

    public function getPresenterClass()
    {
        return InvoicePresenter::class;
    }

}
