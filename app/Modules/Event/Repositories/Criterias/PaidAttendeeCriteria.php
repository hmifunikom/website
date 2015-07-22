<?php namespace HMIF\Modules\Event\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class PaidAttendeeCriteria implements CriteriaInterface {

    private $paid;
    private $invoice;

    public function __construct($paid = 1)
    {
        $this->paid = $paid;
        $this->invoice = app('HMIF\Modules\Invoice\Entities\Invoice');
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $invoiceTable = $this->invoice->getTable();
        $invoiceableId = $invoiceTable . '.invoiceable_id';
        $invoiceableType = $invoiceTable . '.invoiceable_type';
        $invoiceDibayar = $invoiceTable . '.dibayar';

        $attendeeTable = $model->getModel()->getTable();
        $attendeeKey = $attendeeTable.'.'.$model->getModel()->getKeyName();

        $query = $model->join($invoiceTable, $invoiceableId, '=', $attendeeKey)
                    ->where($invoiceableType, $repository->model())
                    ->where($invoiceDibayar, $this->paid);

        return $query;
    }

}
