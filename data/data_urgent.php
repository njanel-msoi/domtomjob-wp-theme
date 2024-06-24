<?php

$URGENT_MAP = [
    ['key' => '1', 'value' => '1', "description" => "Annonce urgente"]
];

function dtj_get_is_urgent()
{
    global $URGENT_MAP;
    return $URGENT_MAP;
}
