<?php

function asset_version($path)
{
    $file = public_path($path);

    if (file_exists($file))
    {
        $parts = explode('.', $path);
        $extension = array_pop($parts);
        array_push($parts, filemtime($file), $extension);
        $path = implode('.', $parts);

        return asset($path, Request::secure());
    }
}