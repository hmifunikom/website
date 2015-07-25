<?php namespace HMIF\Modules\Email\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class TypeCriteria implements CriteriaInterface {

    private $type;

    public function __construct($type = 'in')
    {
        $this->type = $type;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->where('type', $this->type);

        return $query;
    }

}
