<?php

$ANONYMOUS_MAP = [
    ['key' => '1', 'value' => '1', "description" => "Annonce anonyme"]
];

function dtj_get_anonymous()
{
    global $ANONYMOUS_MAP;
    return $ANONYMOUS_MAP;
}
