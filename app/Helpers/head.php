<?php

function head_title($title)
{
    Head::setTitle($title);
}

function head_description($content)
{
    $pagedesc = strip_tags($content);
    $padding = substr($pagedesc, 80);
    $length = strpos($padding, ".");
    if ($padding === 0 || $length === 0)
    {
        $content = $pagedesc;
    }
    else
    {
        $content = substr($pagedesc, 0, min($length + 81, 156));
    }

    Head::setDescription($content);
}

function head_meta($type, $value, $content)
{
    Head::addOneMeta($type, $value, $content);
}

function head_norobot()
{
    head_meta('name', 'robots', 'none');
}