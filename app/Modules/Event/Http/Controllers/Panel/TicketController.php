<?php namespace HMIF\Modules\Event\Http\Controllers\Panel;

use HMIF\Modules\Panel\Http\Controllers\PanelController;
use Input;
use stdClass;
use HMIF\Modules\Event\Http\Requests\StoreTicketPostRequest;
use HMIF\Modules\Event\Repositories\TicketRepository;

class TicketController extends PanelController {

    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function index($event)
    {
        $tickets = $this->ticketRepository->parentModel($event)->paginate();

        head_title('Daftar Tiket - ' . $event->nama_acara);
        return view('event::panel.ticket.index')->with(compact('event', 'tickets'));
    }

    public function create($event)
    {
        head_title('Tambah Tiket - ' . $event->nama_acara);
        return view('event::panel.ticket.create')->with(compact('event'));
    }

    public function store($eventId, StoreTicketPostRequest $request)
    {
        $this->ticketRepository->createRelation($request->all(), ['id_acara' => $eventId]);

        $eventId = hashids_model_encode('event.event', $eventId);

        if($request->has('wizard'))
        {
            flash_success_store('Data tiket sukses ditambah. Event dan tiket siap dilihat.');

            if($request->ajax())
            {
                $addtionalData = new stdClass();
                $addtionalData->linkevent = route('event.show', [$eventId]);
                $addtionalData->linkaddmore = route('panel.event.show', [$eventId]);

                return redirect_ajax_notification('panel.event.show', [$eventId], $addtionalData);
            }
            else
            {
                return redirect_ajax('panel.event.show', [$eventId]);
            }
        }
        else
        {
            flash_success_store('Data tiket sukses ditambah.');

            if($request->ajax())
            {
                return redirect_ajax_notification('panel.event.ticket.index', [$eventId]);
            }
            else
            {
                return redirect_ajax('panel.event.ticket.index', [$eventId]);
            }
        }
    }

    public function edit($event, $ticket)
    {
        head_title('Edit Tiket - ' . $event->nama_acara);
        return view('event::panel.ticket.edit')->with(compact('event', 'ticket'));
    }

    public function update($eventId, $ticketId, StoreTicketPostRequest $request)
    {
        $this->ticketRepository->update($request->all(), $ticketId);

        flash_success_update('Data tiket sukses diubah.');

        $eventId = hashids_model_encode('event.event', $eventId);
        return redirect_ajax('panel.event.ticket.index', $eventId);

    }

    public function destroy($eventId, $ticketId)
    {
        $this->ticketRepository->delete($ticketId);

        flash_success('Tiket sukses dihapus.');

        $eventId = hashids_model_encode('event.event', $eventId);
        return redirect_ajax('panel.event.ticket.index', $eventId);
    }

    public function setStatus($eventId, $ticketId)
    {
        if((bool) Input::get('status'))
        {
            $this->ticketRepository->setAktif($ticketId);
            flash_success('Tiket diaktifkan.');
        }
        else
        {
            $this->ticketRepository->setNonaktif($ticketId);
            flash_success('Tiket dinonaktifkan.');
        }

        $eventId = hashids_model_encode('event.event', $eventId);
        return redirect_ajax('panel.event.ticket.index', $eventId);
    }
}
