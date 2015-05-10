<?php namespace HMIF\Modules\Event\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class PaidAttendeeCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->whereHas('invoice', function($q) {
            $q->where('dibayar', 1);
        });

        return $query;
    }

}
