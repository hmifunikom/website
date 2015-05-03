<?php namespace HMIF\Modules\Event\Repositories;

use HMIF\Repositories\BaseRepository;

class AttendeeRepository extends BaseRepository {

    protected $fieldSearchable = [

    ];

    function model()
    {
        return 'HMIF\Modules\Event\Entities\Attendee';
    }

    public function setSudahBayar($id)
    {
        return $this->setBayar($id);
    }

    public function setBelumBayar($id)
    {
        return $this->setBayar($id, false);
    }

    private function setBayar($id, $status = true)
    {
        $model = $this->find($id);
        $model->aktif = (bool) $status;
        $model->save();

        return $this->parserResult($model);
    }

}
