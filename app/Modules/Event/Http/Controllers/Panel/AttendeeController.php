<?php namespace HMIF\Modules\Event\Http\Controllers\Panel;

use HMIF\Commands\BookEventTicketCommand;
use HMIF\Modules\Event\Repositories\Criterias\ByEventTicketCriteria;
use HMIF\Modules\Event\Repositories\Criterias\PaidAttendeeCriteria;
use HMIF\Modules\Event\Repositories\TicketRepository;
use HMIF\Modules\Event\Repositories\Criterias\AvailableKuotaCriteria;
use Input;
use HMIF\Modules\Event\Http\Requests\StoreAttendeePostRequest;
use HMIF\Modules\Event\Repositories\AttendeeRepository;
use HMIF\Modules\Panel\Http\Controllers\PanelController;

class AttendeeController extends PanelController {

    private $attendeeRepository;
    private $ticketRepository;

    public function __construct(AttendeeRepository $attendeeRepository, TicketRepository $ticketRepository)
    {
        parent::__construct();
        $this->authorizeResource(['class' => $attendeeRepository->model(), 'key' => 'attendee']);
        $this->attendeeRepository = $attendeeRepository;
        $this->ticketRepository = $ticketRepository;
        $this->attendeeRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

    public function index($event)
    {
        $id_tiket = hashids_model_key_decode('event_ticket', Input::get('ticket'));

        if(Input::get('paid'))
        {
            $this->attendeeRepository->pushCriteria(new PaidAttendeeCriteria());
        }

        $tickets = $this->ticketRepository->parentModel($event)->all();
        $attendees = $this->attendeeRepository->pushCriteria(new ByEventTicketCriteria($event->id_acara, $id_tiket))->paginate();

        head_title('Daftar Peserta - ' . $event->nama_acara);
        return view('event::panel.attendee.index')->with(compact('event', 'tickets', 'attendees'));
    }

    public function create($event)
    {
        $tickets = $this->ticketRepository->parentModel($event)
            ->pushCriteria(new AvailableKuotaCriteria())
            ->all();

        head_title('Tambah Peserta - ' . $event->nama_acara);

        return view('event::panel.attendee.create')->with(compact('event', 'tickets'));
    }

    public function store($eventId, StoreAttendeePostRequest $request)
    {
        $bayar = (bool) $request->get('bayar', 0);

        $this->dispatchFrom(BookEventTicketCommand::class, $request, compact($bayar));

        $eventId = hashids_model_encode('event_event', $eventId);

        flash_success_store('Data peserta sukses ditambah.');

        if ($request->ajax())
        {
            return redirect_ajax_notification('panel.event.attendee.index', [$eventId]);
        }
        else
        {
            return redirect_ajax('panel.event.attendee.index', [$eventId]);
        }
    }

    public function show($event, $attendee)
    {

    }

    public function edit($event, $attendee)
    {
        $tickets = $this->ticketRepository->parentModel($event)
            ->pushCriteria(new AvailableKuotaCriteria($attendee->id_tiket))
            ->all();

        head_title('Edit Peserta - ' . $event->nama_acara);

        return view('event::panel.attendee.edit')->with(compact('event', 'tickets', 'attendee'));
    }

    public function update($eventId, $attendeeId, StoreAttendeePostRequest $request)
    {
        $this->attendeeRepository->updateRelation($request->all(), $attendeeId, ['id_tiket' => $request->request->get('tiket')]);

        flash_success_update('Data peserta sukses diubah.');

        $eventId = hashids_model_encode('event_event', $eventId);

        return redirect_ajax('panel.event.attendee.index', $eventId);
    }

    public function destroy($eventId, $attendeeId)
    {
        $this->attendeeRepository->delete($attendeeId);

        flash_success('Peserta sukses dihapus.');

        $eventId = hashids_model_encode('event_event', $eventId);

        return redirect_ajax('panel.event.attendee.index', $eventId);
    }

    public function setPaidStatus($eventId, $attendeeId)
    {
        if ((bool) Input::get('paid'))
        {
            $this->attendeeRepository->setPaid($attendeeId);

            $ticket = $this->attendeeRepository->find($attendeeId);
            event('mail.ticket.pay', $ticket);

            flash_success('Status peserta telah membayar. Tiket dan tanda bukti telah dikirimkan ke email peserta.');
        }
        else
        {
            $this->attendeeRepository->setUnpaid($attendeeId);
            flash_success('Status peserta belum membayar.');
        }

        $eventId = hashids_model_encode('event_event', $eventId);

        return redirect_ajax('panel.event.attendee.index', $eventId);
    }


}
