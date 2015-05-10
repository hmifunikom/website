<?php namespace HMIF\Modules\Event\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ActiveTicketCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->where('aktif', 1);
        return $query;
    }

}
