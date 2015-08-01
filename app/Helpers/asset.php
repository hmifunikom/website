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

function asset_include($path)
{
    $file = public_path($path);

    if (file_exists($file))
    {
        return file_get_contents($file);
    }
}

function asset_link($file)
{
    $default = config('assets.default');

    if($default == 'auto')
    {
        $env = env('APP_ENV');
        if ($env == 'local')
        {
            $default = 'local';
        }
        else
        {
            $default = 'cdn';
        }
    }


    $link = config('assets.files.'.$file.'.'.$default);

    if(! $link)
    {
        $link = config('assets.files.'.$file.'.local');
        $default = 'local';
    }

    if($default == 'local') return asset_version($link);
    return $link;
}

