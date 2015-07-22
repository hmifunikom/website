<?php namespace HMIF\Modules\Invoice\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class PaidCriteria implements CriteriaInterface {

    private $paid;

    public function __construct($paid = 1)
    {
        $this->paid = $paid;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->where('dibayar', $this->paid);

        return $query;
    }

}
