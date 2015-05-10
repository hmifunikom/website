<?php namespace HMIF\Modules\Event\Repositories;

use HMIF\Repositories\BaseRepository;

class AttendeeRepository extends BaseRepository {

    protected $fieldSearchable = [

    ];

    function model()
    {
        return 'HMIF\Modules\Event\Entities\Attendee';
    }

    public function setPaid($id)
    {
        return $this->setPaymentStatus($id);
    }

    public function setUnpaid($id)
    {
        return $this->setPaymentStatus($id, false);
    }

    private function setPaymentStatus($id, $status = true)
    {
        $model = $this->find($id);
        $model = $model->invoice->setBoolean('dibayar', $status);

        return $this->parserResult($model);
    }

}
