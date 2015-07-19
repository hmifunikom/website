<?php namespace HMIF\Modules\Event\Entities\Observers;

use HMIF\Entities\Observers\ModelEvent;
use HMIF\Modules\Event\Repositories\AttendeeRepository;
use HMIF\Modules\Event\Repositories\Criterias\ByEventTicketCriteria;

class AttendeeEvent extends ModelEvent {

    protected $softDeleteChild = [];

    public function saving($model)
    {
        $exist = $model->exists;

        if ( ! $exist)
        {
            $attendeeRepository = app(AttendeeRepository::class);
            $model->load('ticket.event');

            $result = $attendeeRepository->pushCriteria(new ByEventTicketCriteria($model->ticket->event->id_acara, null))
                ->limit(1)
                ->orderBy('kode', 'desc')
                ->all(['kode'])
                ->first();

            if ($result)
            {
                $model->kode = $result->kode + 1;
            }
            else
            {
                $model->kode = 1;
            }

            $model->ticket->increment('terjual');
        }
    }
}
