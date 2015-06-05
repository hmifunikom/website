<?php

// http://www.laravel-tricks.com/tricks/active-states-based-on-route-names
function menu_home($route, $class = false)
{
    if (Request::url() == route($route))
    {
        return ($class) ? 'class="active"' : 'active';
    }
}

function menu_active($route, $class = false)
{
    if (menu_is_active($route))
    {
        return ($class) ? 'class="active"' : 'active';
    }
}

function menu_active_qs($field, $value, $class = false)
{
    if (Input::has($field) && Input::get($field) == $value)
    {
        return ($class) ? 'class="active"' : 'active';
    }
}

function menu_is_active($route)
{
    if (strpos(Request::url(), route($route)) !== false)
    {
        return true;
    }
    else
    {
        return false;
    }
}