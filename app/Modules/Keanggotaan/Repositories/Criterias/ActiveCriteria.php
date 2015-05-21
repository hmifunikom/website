<?php namespace HMIF\Modules\Keanggotaan\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ActiveCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->whereRaw("(status_hima = 'pengurus' OR status_hima = 'am')");

        return $query;
    }

}
