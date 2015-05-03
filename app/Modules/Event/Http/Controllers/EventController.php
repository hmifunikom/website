<?php namespace HMIF\Modules\Event\Http\Controllers;

use Date;
use HMIF\Modules\Event\Repositories\Criterias\DateRangeCriteria;
use HMIF\Modules\Event\Repositories\EventRepository;
use Input;
use Redirect;
use Illuminate\Routing\Controller;

class EventController extends Controller {

    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

	public function index()
	{
        $date = Date::now();

        if(Input::has('month'))
        {
            $date = $date->month(Input::get('month'));
        }

        if(Input::has('year'))
        {
            $date = $date->year(Input::get('year'));
        }

        $event = $this->eventRepository->pushCriteria(new DateRangeCriteria($date))->paginate();
        $total = $this->eventRepository->pushCriteria(new DateRangeCriteria($date, 'year'))->paginate()->total();

		return view('event::index')->with(['pagetitle' => 'Event' , 'date' => $date, 'listacara' => $event, 'total' => $total]);
	}

    public function show($eventId, $slug = null)
    {
        $event = $this->eventRepository->find($eventId);

        if ( $event->slug !== $slug ) {
            return Redirect::route('event.show', ['event' => $event, 'slug' => $event->slug], 301);
        }

        return view('event::item')->with(['pagetitle' => $event->nama_acara, 'event' => $event]);
    }
}