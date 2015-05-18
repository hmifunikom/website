<?php namespace HMIF\Modules\Event\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class PaidAttendeeCriteria implements CriteriaInterface {

    private $invoice;

    public function __construct()
    {
        $this->invoice = app('HMIF\Modules\Invoice\Entities\Invoice');
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $invoiceTable = $this->invoice->getTable();
        $invoiceableId = $invoiceTable . '.invoiceable_id';
        $invoiceableType = $invoiceTable . '.invoiceable_type';
        $invoiceDibayar = $invoiceTable . '.dibayar';

        $attendeeTable = $model->getTable();
        $attendeeKey = $attendeeTable.'.'.$model->getKeyName();

        $query = $model->join($invoiceTable, $invoiceableId, '=', $attendeeKey)
                    ->where($invoiceableType, $repository->model())
                    ->where($invoiceDibayar, 1);

        return $query;
    }

}
