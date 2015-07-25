<?php

function fa($icon)
{
    return "<i class='fa fa-{$icon}'></i>";
}

function parsedown($text, $striptags = false)
{
    $parsedown = new Parsedown();

    return ($striptags) ? strip_tags($parsedown->parse($text)) : $parsedown->parse($text);
}

function to_rp($number)
{
    return 'Rp. ' . number_format($number, 0, ',', '.');
}

function limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit)
    {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[ $limit ]) . '...';
    }

    return $text;
}

function br2nl($buff = '') {
    $buff = preg_replace("/(\r\n|\n|\r)/", "", $buff);
    $buff = preg_replace('#<br[/\s]*>#si', "\n", $buff);
    $buff = trim($buff);

    return $buff;
}