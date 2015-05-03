<?php

function delete_media($file)
{
    File::delete(public_path('media/images/'.$file));
    File::delete(public_path('media/thumbs/'.$file));
}