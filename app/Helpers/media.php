<?php

function delete_media($file)
{
    File::delete(public_path('media/images/' . $file));
    File::delete(public_path('media/thumbs/' . $file));
}

function gravatarlib($email, $size = 80, $rating = null)
{
    $gravatar = new thomaswelton\GravatarLib\Gravatar();

    $gravatar->setAvatarSize($size);

    if ( ! is_null($rating))
    {
        $gravatar->setMaxRating($rating);
    }

    $gravatar->enableSecureImages();

    return htmlentities($gravatar->buildGravatarURL($email));
}

function avatar($path)
{
    if ($path)
    {
        return asset_version('media/thumbs/' . $path);
    }
    else
    {
        return asset_version('media/thumbs/avatar.jpg');
    }
}