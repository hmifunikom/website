<?php namespace HMIF\Modules\Event\Entities\Observers;

use HMIF\Entities\Observers\ModelEvent;
use Input;

class AttendeeEvent extends ModelEvent {

    protected $softDeleteChild = ['ticket'];

    public function saving($model)
    {
        $exist = $model->find($model->id_peserta);

        if ( ! $exist)
        {
            $result = DB::table($model->getTable())
                ->select('kode')
                ->where('id_tiket', $model->id_tiket)
                ->orderBy('kode', 'desc')
                ->take(1)
                ->get();

            if ($result)
            {
                $model->kode = $result[0]->kode + 1;
            }
            else
            {
                $model->kode = 1;
            }
        }
    }
}
