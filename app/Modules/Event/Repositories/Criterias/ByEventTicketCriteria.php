<?php namespace HMIF\Modules\Event\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ByEventTicketCriteria implements CriteriaInterface {

    private $event;
    private $ticket;

    private $event_id;
    private $ticket_id;

    public function __construct($event_id = null, $ticket_id = null)
    {
        $this->event = app('HMIF\Modules\Event\Entities\Event');
        $this->ticket = app('HMIF\Modules\Event\Entities\Ticket');

        $this->event_id = $event_id;
        $this->ticket_id = $ticket_id;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $eventTable = $this->event->getTable();
        $eventKey = $eventTable.'.'.$this->event->getKeyName();

        $ticketTable = $this->ticket->getTable();
        $ticketKey = $ticketTable.'.'.$this->ticket->getKeyName();
        $ticketFKey = $ticketTable.'.'.$this->event->getKeyName();

        $attendeeTable = $model->getModel()->getTable();
        $attendeeFKey = $attendeeTable.'.'.$this->ticket->getKeyName();

        $query = $model->join($ticketTable, $ticketKey, '=', $attendeeFKey)
                        ->join($eventTable, $eventKey, '=', $ticketFKey);

        if($this->event_id !== null)
        {
            $query = $query->where($eventKey, $this->event_id);
        }

        if($this->ticket_id !== null)
        {
            $query = $query->where($ticketKey, $this->ticket_id);
        }

        return $query;
    }

}
