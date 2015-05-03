<?php namespace HMIF\Modules\Event\Repositories\Criterias;

use Carbon\Carbon;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class DateRangeCriteria implements CriteriaInterface {

    private $time;
    private $rangeBy;

    /**
     * @param Carbon $time
     * @param string $rangeBy
     */
    public function __construct(Carbon $time, $rangeBy = 'month')
    {
        $this->time = $time;
        $this->rangeBy = $rangeBy;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->whereRaw("YEAR(mulai) = YEAR(?)", [$this->time]);

        if($this->rangeBy == 'month')
        {
            $query = $query->whereRaw("MONTH(mulai) = MONTH(?) ", [$this->time]);
        }

        $query = $query->orderBy('mulai', 'asc');

        return $query;
    }

}
