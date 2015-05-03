<?php namespace HMIF\Modules\User\Repositories;

use HMIF\Repositories\BaseRepository;

class UserRepository extends BaseRepository {

    protected $fieldSearchable = [
        'username',
    ];

    public function boot()
    {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

    function model()
    {
        return 'HMIF\Modules\User\Entities\User';
    }

}
