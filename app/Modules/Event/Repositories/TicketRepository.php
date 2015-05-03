<?php namespace HMIF\Modules\Event\Repositories;

use HMIF\Repositories\BaseRepository;

class TicketRepository extends BaseRepository {

    protected $fieldSearchable = [

    ];

    function model()
    {
        return 'HMIF\Modules\Event\Entities\Ticket';
    }

    public function setAktif($id)
    {
        return $this->setStatus($id);
    }

    public function setNonaktif($id)
    {
        return $this->setStatus($id, false);
    }

    private function setStatus($id, $status = true)
    {
        $model = $this->find($id);
        $model->aktif = (bool) $status;
        $model->save();

        return $this->parserResult($model);
    }

}
