<?php namespace HMIF\Modules\Event\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class AvailableKuotaCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->whereRaw('terjual < kuota');
        return $query;
    }

}
