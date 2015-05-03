<?php namespace HMIF\Modules\Event\Http\Controllers\Panel;

use stdClass;
use HMIF\Libraries\ImageManipulation;
use HMIF\Http\Controllers\Controller;
use HMIF\Modules\Event\Http\Requests\StoreEventPostRequest;
use HMIF\Modules\Event\Repositories\EventRepository;

class EventController extends Controller {

    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function index()
    {
        $events = $this->eventRepository->paginate();

        return view('event::panel.index')->with(['events' => $events]);
    }

    public function create()
    {
        return view('event::panel.create')->with(['method' => 'create']);
    }

    public function store(StoreEventPostRequest $request)
    {
        $event = $this->eventRepository->create($request->all());

        flash_success_store('Data event sukses ditambah. Silahkan membuat tiket untuk event.');

        if ($request->ajax())
        {
            $addtionalData = new stdClass();
            $addtionalData->nextaction = route('panel.event.ticket.store', [$event, 'wizard' => true]);

            return redirect_ajax_notification('panel.event.ticket.create', [$event, 'wizard' => true], $addtionalData);
        }
        else
        {
            return redirect_ajax('panel.event.ticket.create', [$event, 'wizard' => true]);
        }
    }

    public function show($event)
    {
        return view('event::panel.show')->with(compact('event'));
    }

    public function edit($event)
    {
        return view('event::panel.edit')->with(compact('event'));
    }

    public function update($eventId, StoreEventPostRequest $request)
    {
        $event = $this->eventRepository->update($request->all(), $eventId);

        flash_success_update('Data event sukses diubah.');

        return redirect_ajax('panel.event.show', $event);
    }

    public function destroy($eventId)
    {
        $this->eventRepository->delete($eventId);

        flash_success('Event sukses dihapus.');

        return redirect_ajax('panel.event.index');
    }

    public function posterStore($eventId)
    {
        if(! is_ajax()) redirect_ajax('panel.event.show', $eventId);

        $event = $this->eventRepository->find($eventId);

        $filename = str_slug($event->nama_acara);
        $img = new ImageManipulation('posterupload', $filename);

        if ($img->isUploaded())
        {
            $img->resize();
            $img->thumb();

            if ($event->poster)
            {
                delete_media($event->poster);
            }

            $event->poster = $img->getFileName();

            if ($event->save())
            {
                flash_success('Poster sukses disimpan.');
                $response = new stdClass();
                $response->path = asset_version('media/images/' . $img->getFileName());
                return response_ajax($response);
            }
            else
            {
                flash_error('Poster gagal disimpan.');
                return response_ajax_fail();
            }
        }
        else
        {
            flash_error('Poster gagal diunggah.');
            return response_ajax_fail();
        }
    }

    public function posterDelete($eventId)
    {
        $event = $this->eventRepository->find($eventId);

        $tmp_poster = $event->poster;
        $event->poster = null;

        if ($event->save())
        {
            delete_media($tmp_poster);
            flash_success('Poster sukses dihapus.');
        }
        else
        {
            flash_error('Poster gagal dihapus.');
        }

        return redirect_ajax_notification('panel.event.show', $event);
    }
}
