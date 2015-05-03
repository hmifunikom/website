<?php

function array_implode($array, $key)
{
    $array = $array->toArray();
    $array = array_fetch($array, $key);

    return implode($array, ', ');
}

function object_merge($object1, $object2)
{
    return (object) array_merge((array) $object1, (array) $object2);
}
