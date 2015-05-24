<?php

Breadcrumbs::setView('panel::partials.breadcrumbs');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Breadcrumbs::register('panel.index', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('panel.index'));
});

/*
|--------------------------------------------------------------------------
| Keanggotaan
|--------------------------------------------------------------------------
*/

Breadcrumbs::register('panel.keanggotaan.anggota.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('Keanggotaan');
    $breadcrumbs->push('Anggota', route('panel.keanggotaan.anggota.index'));
});

Breadcrumbs::register('panel.keanggotaan.anggota.show', function($breadcrumbs, $anggota) {
    $breadcrumbs->parent('panel.keanggotaan.anggota.index');
    $breadcrumbs->push($anggota->nama, route('panel.keanggotaan.anggota.show', $anggota));
});

Breadcrumbs::register('panel.keanggotaan.anggota.edit', function($breadcrumbs, $anggota) {
    $breadcrumbs->parent('panel.keanggotaan.anggota.show', $anggota);
    $breadcrumbs->push('Edit Anggota');
});

/*
|--------------------------------------------------------------------------
| Event
|--------------------------------------------------------------------------
*/

// Index

Breadcrumbs::register('panel.event.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('Acara', route('panel.event.index'));
});

Breadcrumbs::register('panel.event.create', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.event.index');
    $breadcrumbs->push('Tambah Acara');
});

Breadcrumbs::register('panel.event.show', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.index');
    $breadcrumbs->push($event->nama_acara, route('panel.event.show', $event));
});

Breadcrumbs::register('panel.event.edit', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.show', $event);
    $breadcrumbs->push('Edit Acara');
});

// Ticket

Breadcrumbs::register('panel.event.ticket.index', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.show', $event);
    $breadcrumbs->push('Tiket', route('panel.event.ticket.index', $event));
});

Breadcrumbs::register('panel.event.ticket.create', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.ticket.index', $event);
    $breadcrumbs->push('Tambah Tiket');
});

Breadcrumbs::register('panel.event.ticket.edit', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.ticket.index', $event);
    $breadcrumbs->push('Edit Tiket');
});

// attendee

Breadcrumbs::register('panel.event.attendee.index', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.show', $event);
    $breadcrumbs->push('Peserta', route('panel.event.attendee.index', $event));
});

Breadcrumbs::register('panel.event.attendee.show', function ($breadcrumbs, $event, $attendee) {
    $breadcrumbs->parent('panel.event.attendee.index', $event);
    $breadcrumbs->push($attendee->nama_attendee, route('panel.event.attendee.show', array($event, $attendee->id_peserta)));
});

Breadcrumbs::register('panel.event.attendee.create', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.attendee.index', $event);
    $breadcrumbs->push('Tambah Peserta');
});

Breadcrumbs::register('panel.event.attendee.edit', function ($breadcrumbs, $event, $attendee) {
    $breadcrumbs->parent('panel.event.attendee.index', $event);
    $breadcrumbs->push('Edit Peserta');
});

