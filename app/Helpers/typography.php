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