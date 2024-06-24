<?php

$FULLTIME_TYPE = [
    "FULLTIME" => "Temps plein",
    "PARTTIME" => "Temps partiel"
];
$FULLTIME_TYPE_MAP = str_arr_to_data_map($FULLTIME_TYPE, true);


function dtj_get_fulltime_type()
{
    global $FULLTIME_TYPE_MAP;
    return $FULLTIME_TYPE_MAP;
}


function dtj_get_fulltime_type_from_key($key)
{
    if (!$key) return '';
    global $FULLTIME_TYPE;
    return $FULLTIME_TYPE[$key];
}
