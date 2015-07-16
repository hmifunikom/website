<?php namespace HMIF\Modules\Event\Http\Controllers;

use HMIF\Commands\BookEventTicketCommand;
use HMIF\Http\Controllers\Controller;
use HMIF\Modules\Event\Http\Requests\StoreAttendeePostRequest;
use HMIF\Modules\Event\Repositories\Criterias\AvailableKuotaCriteria;
use HMIF\Modules\Event\Repositories\Criterias\UpcomingEventCriteria;
use HMIF\Modules\Event\Repositories\EventRepository;
use HMIF\Modules\Event\Repositories\TicketRepository;
use Input;
use Redirect;

class EventController extends Controller {

    private $eventRepository;
    private $ticketRepository;

    public function __construct(EventRepository $eventRepository, TicketRepository $ticketRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->ticketRepository = $ticketRepository;
    }

	public function index()
	{
        $upcoming = $this->eventRepository->pushCriteria(new UpcomingEventCriteria(6))->all();
        $events = $this->eventRepository->reset()->orderBy('mulai', 'desc')->limit(6)->all();

        head_title('Event');
		return view('event::index')->with(compact('upcoming', 'events'));
	}

    public function show($eventId, $slug = null)
    {
        $event = $this->eventRepository->find($eventId);
        $tickets = $this->ticketRepository->parentModel($event)
            ->pushCriteria(new AvailableKuotaCriteria())
            ->all();

        if ( $event->slug !== $slug ) {
            return Redirect::route('event.show', ['event' => $event, 'slug' => $event->slug], 301);
        }

        head_title($event->nama_acara);
        head_description(parsedown($event->info));

        if($event->poster)
        {
            $image = asset_version('media/images/'.$event->poster);
            head_meta('property', 'og:image', $image);
            head_meta('name', 'twitter:image:src', $image);
        }

        return view('event::item')->with(compact('event', 'tickets'));
    }

    public function store($eventId, $slug = null, StoreAttendeePostRequest $request)
    {
        $event = $this->eventRepository->find($eventId);

        if ( $event->slug !== $slug ) {
            return Redirect::route('event.show', ['event' => $event, 'slug' => $event->slug], 301);
        }

        $bayar = 0;
        $this->dispatchFrom(BookEventTicketCommand::class, $request, compact($bayar));

        flash_success_store('Data peserta sukses ditambah.');

        if ($request->ajax())
        {
            return redirect_ajax_notification('event.show', ['event' => $event, 'slug' => $event->slug]);
        }
        else
        {
            return redirect_ajax('event.show', ['event' => $event, 'slug' => $event->slug]);
        }
    }
}