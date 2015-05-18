<?php namespace HMIF\Modules\Event\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class AvailableKuotaCriteria implements CriteriaInterface {

    private $exceptId;

    public function __construct($exceptId = null)
    {
        $this->exceptId = $exceptId;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->whereRaw('terjual < kuota');

        if($this->exceptId)
        {
            $query = $query->orWhere('id_tiket', $this->exceptId);
        }

        return $query;
    }

}
