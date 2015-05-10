<?php namespace HMIF\Modules\Event\Http\Controllers\Panel;

use HMIF\Modules\Event\Repositories\TicketRepository;
use HMIF\Modules\Event\Repositories\Criterias\AvailableKuotaCriteria;
use Input;
use stdClass;
use HMIF\Modules\Event\Http\Requests\StoreAttendeePostRequest;
use HMIF\Modules\Event\Repositories\AttendeeRepository;
use HMIF\Modules\Panel\Http\Controllers\PanelController;

class AttendeeController extends PanelController {

    private $attendeeRepository;
    private $ticketRepository;

    public function __construct(AttendeeRepository $attendeeRepository, TicketRepository $ticketRepository)
    {
        parent::__construct();
        $this->attendeeRepository = $attendeeRepository;
        $this->ticketRepository = $ticketRepository;
    }

    public function index($event)
    {


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
        $bayar = $request->get('bayar', 0);

        if ( ! $bayar)
        {
            $this->attendeeRepository->createRelation($request->all(), ['id_tiket' => $request->request->get('tiket')]);
        }
        else
        {

        }

        $eventId = hashids_model_encode('event.event', $eventId);

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

    public function edit($event, $attendee)
    {
        head_title('Edit Peserta - ' . $event->nama_acara);

        return view('event::panel.attendee.edit')->with(compact('event', 'attendee'));
    }

    public function update($eventId, $attendeeId, StoreAttendeePostRequest $request)
    {
        $this->attendeeRepository->updateRelation($request->all(), $attendeeId, ['id_tiket' => $request->request->get('id_tiket')]);

        flash_success_update('Data peserta sukses diubah.');

        $eventId = hashids_model_encode('event.event', $eventId);

        return redirect_ajax('panel.event.attendee.index', $eventId);
    }

    public function destroy($eventId, $attendeeId)
    {
        $this->attendeeRepository->delete($attendeeId);

        flash_success('Peserta sukses dihapus.');

        $eventId = hashids_model_encode('event.event', $eventId);

        return redirect_ajax('panel.event.attendee.index', $eventId);
    }

    public function setPaidStatus($eventId, $attendeeId)
    {
        if ((bool) Input::get('paid'))
        {
            $this->attendeeRepository->setPaid($attendeeId);
            flash_success('Status peserta telah membayar. Tiket dan tanda bukti telah dikirimkan ke email peserta.');
        }
        else
        {
            $this->attendeeRepository->setUnpaid($attendeeId);
            flash_success('Status peserta belum membayar.');
        }

        $eventId = hashids_model_encode('event.event', $eventId);

        return redirect_ajax('panel.event.attendee.index', $eventId);
    }


}
