<?php namespace HMIF\Modules\Keanggotaan\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ByStatusCriteria implements CriteriaInterface {

    private $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if($this->status !== null && in_array($this->status, ['pengurus', 'am']))
        {
            $model = $model->where('status_hima', $this->status);
        }

        return $model;
    }

}
