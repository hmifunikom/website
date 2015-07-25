<?php namespace HMIF\Modules\Email\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class UnreadedCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->where('readed', 0);

        return $query;
    }

}
