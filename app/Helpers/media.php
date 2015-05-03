<?php

function delete_media($file)
{
    File::delete(public_path('media/images/'.$file));
    File::delete(public_path('media/thumbs/'.$file));
}

function gravatar($email, $size = 80, $rating = null)
{
    $gravatar = new thomaswelton\GravatarLib\Gravatar();

    $gravatar->setAvatarSize($size);

    if (! is_null($rating)) {
        $gravatar->setMaxRating($rating);
    }

    $gravatar->enableSecureImages();

    return htmlentities($gravatar->buildGravatarURL($email));
}