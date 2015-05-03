<?php namespace HMIF\Modules\Event\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class UpcomingEventCriteria implements CriteriaInterface {

    private $limit;

    /**
     * @param $limit
     */
    public function __construct($limit = 1)
    {
        $this->limit = $limit;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->whereRaw("CURRENT_DATE <= mulai")
            ->orderBy('mulai', 'asc')
            ->take($this->limit);

        return $query;
    }

}
