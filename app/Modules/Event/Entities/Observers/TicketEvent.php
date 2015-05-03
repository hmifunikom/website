<?php namespace HMIF\Modules\Event\Entities\Observers;

use HMIF\Entities\Observers\ModelEvent;
use Input;

class TicketEvent extends ModelEvent {
    protected $softDeleteChild = ['attendee'];

    public function saving($model)
    {
        if(Input::has('mulai_tanggal') && Input::has('mulai_waktu'))
        {
            $model->mulai = Input::get('mulai_tanggal') . ' ' . Input::get('mulai_waktu');
        }
    }
}
