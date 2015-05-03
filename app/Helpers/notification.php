<?php

function flash_notification($title, $text, $sticky = false, $image = null)
{
    $notification = new stdClass();
    $notification->title = $title;
    $notification->text = $text;
    $notification->sticky = $sticky;
    $notification->image = $image;

    Session::put('notification', $notification);
}

function flash_success_store($text, $sticky = false)
{
    flash_notification('Sukses menambah!', $text, $sticky);
}

function flash_success_update($text, $sticky = false)
{
    flash_notification('Sukses mengubah!', $text, $sticky);
}

function flash_success($text, $sticky = false)
{
    flash_notification('Sukses!', $text, $sticky);
}

function flash_error($text)
{
    flash_notification('Oops.. Sesuatu yang tidak diinginkan!', $text, true);
}

function show_notification()
{
    if ( ! Session::has('notification')) return '';

    $notification = Session::get('notification');
    Session::forget('notification');

    $template = "
    $.gritter.add({
        title: '{$notification->title}',
        text: '{$notification->text}',
        image: '{$notification->image}',
        sticky: " . (int) $notification->sticky . ",
        time: '10000',
    });";

    return $template;
}
