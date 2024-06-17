<?php

$FULLTIME_TYPE_MAP = [
    ['key' => 'FULLTIME', 'value' => 'FULLTIME', "description" => "Temps plein"],
    ['key' => 'PARTTIME', 'value' => 'PARTTIME', "description" => "Temps partiel"]
];

function dtj_get_fulltime_type()
{
    global $FULLTIME_TYPE_MAP;
    return $FULLTIME_TYPE_MAP;
}
