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

Breadcrumbs::register('panel.keanggotaan.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('Keanggotaan', route('panel.keanggotaan.index'));
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

// Waktu

Breadcrumbs::register('panel.event.waktu.index', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.show', $event);
    $breadcrumbs->push('Waktu', route('panel.event.waktu.index', $event));
});

Breadcrumbs::register('panel.event.waktu.create', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.waktu.index', $event);
    $breadcrumbs->push('Tambah Waktu');
});

Breadcrumbs::register('panel.event.waktu.edit', function ($breadcrumbs, $event, $waktu) {
    $breadcrumbs->parent('panel.event.waktu.index', $event);
    $breadcrumbs->push('Edit Waktu');
});

// Panitia

Breadcrumbs::register('panel.event.panitia.index', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.show', $event);
    $breadcrumbs->push('Panitia', route('panel.event.panitia.index', $event));
});

Breadcrumbs::register('panel.event.panitia.create', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.panitia.index', $event);
    $breadcrumbs->push('Tambah Panitia');
});

Breadcrumbs::register('panel.event.panitia.edit', function ($breadcrumbs, $event, $panitia) {
    $breadcrumbs->parent('panel.event.panitia.index', $event);
    $breadcrumbs->push('Edit Panitia');
});

// Div. Acara

Breadcrumbs::register('panel.event.div.index', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.show', $event);
    $breadcrumbs->push('Divisi Acara', route('panel.event.div.index', $event));
});

Breadcrumbs::register('panel.event.div.create', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.div.index', $event);
    $breadcrumbs->push('Tambah Divisi Acara');
});

Breadcrumbs::register('panel.event.div.edit', function ($breadcrumbs, $event, $div) {
    $breadcrumbs->parent('panel.event.div.index', $event);
    $breadcrumbs->push('Edit Divisi Acara');
});

// Peserta

Breadcrumbs::register('panel.event.peserta.index', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.show', $event);
    $breadcrumbs->push('Peserta', route('panel.event.peserta.index', $event));
});

Breadcrumbs::register('panel.event.peserta.show', function ($breadcrumbs, $event, $peserta) {
    $breadcrumbs->parent('panel.event.peserta.index', $event);
    $breadcrumbs->push($peserta->nama_peserta, route('panel.event.peserta.show', array($event, $peserta->id_peserta)));
});

Breadcrumbs::register('panel.event.peserta.create', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('panel.event.peserta.index', $event);
    $breadcrumbs->push('Tambah Peserta');
});

Breadcrumbs::register('panel.event.peserta.edit', function ($breadcrumbs, $event, $peserta) {
    $breadcrumbs->parent('panel.event.peserta.index', $event);
    $breadcrumbs->push('Edit Peserta');
});

/*
|--------------------------------------------------------------------------
| IF Games
|--------------------------------------------------------------------------
*/

// Index

Breadcrumbs::register('panel.ifgames.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('IF Games', route('panel.ifgames.index'));
    $breadcrumbs->push('Cabang', route('panel.ifgames.index'));
});

Breadcrumbs::register('panel.ifgames.create', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.ifgames.index');
    $breadcrumbs->push('Tambah Cabang');
});

Breadcrumbs::register('panel.ifgames.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.ifgames.index');
    $breadcrumbs->push('Edit Cabang');
});

// Tim

Breadcrumbs::register('panel.ifgames.tim.index', function ($breadcrumbs, $cabang) {
    $breadcrumbs->parent('panel.ifgames.index');
    $breadcrumbs->push($cabang->nama_cabang, route('panel.ifgames.tim.index', $cabang->id_cabang));
    if($cabang->anggota > 1)
        $breadcrumbs->push('Tim', route('panel.ifgames.tim.index', $cabang->id_cabang));
    else
        $breadcrumbs->push('Peserta', route('panel.ifgames.tim.index', $cabang->id_cabang));
});

Breadcrumbs::register('panel.ifgames.tim.create', function ($breadcrumbs, $cabang) {
    $breadcrumbs->parent('panel.ifgames.tim.index', $cabang);
    if($cabang->anggota > 1)
        $breadcrumbs->push('Tambah Tim');
    else
        $breadcrumbs->push('Tambah Peserta');
});

Breadcrumbs::register('panel.ifgames.tim.edit', function ($breadcrumbs, $cabang) {
    $breadcrumbs->parent('panel.ifgames.tim.index', $cabang);
    if($cabang->anggota > 1)
        $breadcrumbs->push('Edit Tim');
    else
        $breadcrumbs->push('Edit Peserta');
});

// Anggota

Breadcrumbs::register('panel.ifgames.tim.anggota.index', function ($breadcrumbs, $cabang, $tim) {
    $breadcrumbs->parent('panel.ifgames.tim.index', $cabang);
    $breadcrumbs->push($tim->nama_tim, route('panel.ifgames.tim.anggota.index', array($cabang->id_cabang, $tim->id_tim)));
    $breadcrumbs->push('Anggota', route('panel.ifgames.tim.anggota.index', array($cabang->id_cabang, $tim->id_tim)));
});

Breadcrumbs::register('panel.ifgames.tim.anggota.create', function ($breadcrumbs, $cabang, $tim) {
    $breadcrumbs->parent('panel.ifgames.tim.anggota.index', $cabang, $tim);
    $breadcrumbs->push('Tambah Anggota');
});

Breadcrumbs::register('panel.ifgames.tim.anggota.edit', function ($breadcrumbs, $cabang, $tim) {
    $breadcrumbs->parent('panel.ifgames.tim.anggota.index', $cabang, $tim);
    $breadcrumbs->push('Edit Anggota');
});

/*
|--------------------------------------------------------------------------
| Pelatihan
|--------------------------------------------------------------------------
*/

// Index

Breadcrumbs::register('panel.pelatihan.anggota.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('Pelatihan', route('panel.pelatihan.anggota.index'));
    $breadcrumbs->push('Anggota', route('panel.pelatihan.anggota.index'));
});

Breadcrumbs::register('panel.pelatihan.anggota.create', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.pelatihan.anggota.index');
    $breadcrumbs->push('Tambah Anggota');
});

Breadcrumbs::register('panel.pelatihan.anggota.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.pelatihan.anggota.index');
    $breadcrumbs->push('Edit Anggota');
});

/*
|--------------------------------------------------------------------------
| Pelatihan
|--------------------------------------------------------------------------
*/

// Index

Breadcrumbs::register('panel.kbm.anggota.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('KBM', route('panel.kbm.anggota.index'));
    $breadcrumbs->push('Anggota', route('panel.kbm.anggota.index'));
});

Breadcrumbs::register('panel.kbm.anggota.create', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.kbm.anggota.index');
    $breadcrumbs->push('Tambah Anggota');
});

Breadcrumbs::register('panel.kbm.anggota.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.kbm.anggota.index');
    $breadcrumbs->push('Edit Anggota');
});

/*
|--------------------------------------------------------------------------
| Cakrawala
|--------------------------------------------------------------------------
*/

// Index

Breadcrumbs::register('panel.cakrawala.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('Cakrawala', route('panel.cakrawala.index'));
});

// Pembayaran

Breadcrumbs::register('panel.cakrawala.pembayaran.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.cakrawala.index');
    $breadcrumbs->push('Pembayaran', route('panel.cakrawala.pembayaran.index'));
});

Breadcrumbs::register('panel.cakrawala.pembayaran.kuitansi', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.cakrawala.pembayaran.index');
    $breadcrumbs->push('Kuitansi');
});

// Kompetisi

Breadcrumbs::register('panel.cakrawala.kompetisi.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.cakrawala.index');
    $breadcrumbs->push('Kompetisi', route('panel.cakrawala.kompetisi.index'));
});

// Tim

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.index', function ($breadcrumbs, $lomba) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.index');
    $breadcrumbs->push($lomba, route('panel.cakrawala.kompetisi.tim.index', $lomba));
    $breadcrumbs->push('Tim', route('panel.cakrawala.kompetisi.tim.index', $lomba));
});

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.create', function ($breadcrumbs, $lomba) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.index', $lomba);
    $breadcrumbs->push('Tambah Tim');
});

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.show', function ($breadcrumbs, $lomba, $tim) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.index', $lomba);
    $breadcrumbs->push($tim->nama_tim, route('panel.cakrawala.kompetisi.tim.show', array($lomba, $tim->id_tim)));
});

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.edit', function ($breadcrumbs, $lomba) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.index', $lomba);
    $breadcrumbs->push('Edit Tim');
});

// Anggota

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.anggota.index', function ($breadcrumbs, $lomba, $tim) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.show', $lomba, $tim);
    $breadcrumbs->push('Anggota', route('panel.cakrawala.kompetisi.tim.anggota.index', array($lomba, $tim->id_tim)));
});

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.anggota.create', function ($breadcrumbs, $lomba, $tim) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.anggota.index', $lomba, $tim);
    $breadcrumbs->push('Tambah Anggota');
});

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.anggota.edit', function ($breadcrumbs, $lomba, $tim) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.anggota.index', $lomba, $tim);
    $breadcrumbs->push('Edit Anggota');
});

// Persyaratan

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.persyaratan.index', function ($breadcrumbs, $lomba, $tim) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.show', $lomba, $tim);
    $breadcrumbs->push('Persyaratan', route('panel.cakrawala.kompetisi.tim.persyaratan.index', array($lomba, $tim->id_tim)));
});

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.persyaratan.create', function ($breadcrumbs, $lomba, $tim) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.persyaratan.index', $lomba, $tim);
    $breadcrumbs->push('Upload Persyaratan');
});

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.persyaratan.edit', function ($breadcrumbs, $lomba, $tim) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.persyaratan.index', $lomba, $tim);
    $breadcrumbs->push('Ganti Persyaratan');
});

// Karya

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.karya.index', function ($breadcrumbs, $lomba, $tim) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.show', $lomba, $tim);
    $breadcrumbs->push('Karya', route('panel.cakrawala.kompetisi.tim.karya.index', array($lomba, $tim->id_tim)));
});

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.karya.create', function ($breadcrumbs, $lomba, $tim) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.karya.index', $lomba, $tim);
    $breadcrumbs->push('Upload Karya');
});

Breadcrumbs::register('panel.cakrawala.kompetisi.tim.karya.edit', function ($breadcrumbs, $lomba, $tim) {
    $breadcrumbs->parent('panel.cakrawala.kompetisi.tim.karya.index', $lomba, $tim);
    $breadcrumbs->push('Ganti Karya');
});

// The Color Run

Breadcrumbs::register('panel.cakrawala.tcr.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.cakrawala.index');
    $breadcrumbs->push('The Color Run', route('panel.cakrawala.tcr.index'));
    $breadcrumbs->push('Peserta', route('panel.cakrawala.tcr.index'));
});

Breadcrumbs::register('panel.cakrawala.tcr.create', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.cakrawala.tcr.index');
    $breadcrumbs->push('Tambah Peserta');
});

Breadcrumbs::register('panel.cakrawala.tcr.show', function ($breadcrumbs, $peserta) {
    $breadcrumbs->parent('panel.cakrawala.tcr.index');
    $breadcrumbs->push($peserta->nama_peserta, route('panel.cakrawala.tcr.show', array($peserta->id_peserta)));
});

Breadcrumbs::register('panel.cakrawala.tcr.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.cakrawala.tcr.index');
    $breadcrumbs->push('Edit Peserta');
});

/*
|--------------------------------------------------------------------------
| Arsip
|--------------------------------------------------------------------------
*/

// Index

Breadcrumbs::register('panel.arsip.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('Arsip', route('panel.arsip.index'));
    $breadcrumbs->push('Dokumen', route('panel.arsip.index'));
});

Breadcrumbs::register('panel.arsip.create', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.arsip.index');
    $breadcrumbs->push('Tambah Dokumen');
});

Breadcrumbs::register('panel.arsip.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.arsip.index');
    $breadcrumbs->push('Edit Dokumen');
});

/*
|--------------------------------------------------------------------------
| Arsip
|--------------------------------------------------------------------------
*/

// Index

Breadcrumbs::register('panel.user.index', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('User', route('panel.user.index'));
});

Breadcrumbs::register('panel.user.create', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.user.index');
    $breadcrumbs->push('Tambah User');
});

Breadcrumbs::register('panel.user.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('panel.user.index');
    $breadcrumbs->push('Edit User');
});
