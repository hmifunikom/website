<?php

function head_description($content)
{

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