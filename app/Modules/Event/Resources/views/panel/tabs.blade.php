{!!
    Navigation::pills([
        [
            'title' => Icon::info() . ' Informasi',
            'link' => route('panel.event.show', $event->getWrappedObject()),
            'linkAttributes' => ['data-pjax' => true],
        ],
        [
            'title' => Icon::ticket() . ' Tiket',
            'link' => route('panel.event.ticket.index', $event->getWrappedObject()),
            'linkAttributes' => ['data-pjax' => true],
        ],
    ])
!!}