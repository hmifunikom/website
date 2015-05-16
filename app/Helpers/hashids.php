<?php

function hashids_model_encode()
{
    $args = func_get_args();
    $model = $args[0];
    $data = array_slice($args, 1);

    $connection = config('hashids.model.' . $model);
    return Hashids::connection($connection)->encode($data);
}

function hashids_model_decode($model, $hash)
{
    $connection = config('hashids.model.' . $model);
    return Hashids::connection($connection)->decode($hash);
}

function hashids_model_key_decode($model, $hash)
{
    $key = hashids_model_decode($model, $hash);
    if(isset($key[0]))
    {
        return $key[0];
    }

    return null;
}