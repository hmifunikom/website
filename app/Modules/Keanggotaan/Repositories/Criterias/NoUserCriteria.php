<?php namespace HMIF\Modules\Keanggotaan\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class NoUserCriteria implements CriteriaInterface {

    private $user;

    public function __construct()
    {
        $this->user = app('HMIF\Modules\User\Entities\User');
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $userTable = $this->user->getTable();
        $userableId = $userTable . '.userable_id';

        $anggotaTable = $model->getModel()->getTable();
        $anggotaKey = $anggotaTable . '.' . $model->getModel()->getKeyName();

        $query = $model->leftJoin($userTable, $userableId, '=', $anggotaKey)
            ->whereRaw($userableId . ' IS NULL');

        return $query;
    }

}
