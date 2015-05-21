<?php namespace HMIF\Modules\Keanggotaan\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class OrganigramCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->orderBy('id_divisi', 'asc')->orderBy('nama', 'asc');

        return $query;
    }

}
