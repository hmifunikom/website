<?php namespace HMIF\Modules\Event\Entities\Observers;

use HMIF\Entities\Observers\ModelEvent;
use HMIF\Modules\Event\Repositories\AttendeeRepository;
use HMIF\Modules\Event\Repositories\Criterias\ByEventTicketCriteria;
use DB;

class AttendeeEvent extends ModelEvent {

    protected $softDeleteChild = [];

    public function creating($model)
    {
        DB::beginTransaction();

        $attendeeRepository = app(AttendeeRepository::class);
        $model->load('ticket.event');

        $result = $attendeeRepository->pushCriteria(new ByEventTicketCriteria($model->ticket->event->id_acara, null))
            ->limit(1)
            ->orderBy('kode', 'desc')
            ->lockUpdate()
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

    public function created($model)
    {
        DB::commit();
    }
}
