<?php

$COUNTRIES_MAP = [];

function dtj_get_countries()
{
    global $COUNTRIES_MAP;
    if (count($COUNTRIES_MAP) == 0) {
        $countries = Wpjb_List_Country::getAll();
        $COUNTRIES_MAP = array_map(function ($country) {
            return [
                "key" => $country["code"],
                "value" => $country["code"],
                "description" => $country["name"]
            ];
        }, $countries);
    }
    return $COUNTRIES_MAP;
}
function dtj_get_country_from_key($key)
{
    global $COUNTRIES_MAP;
    foreach ($COUNTRIES_MAP as $value) {
        if ($value['key'] == $key) {
            return $value['description'];
        }
    }
    return '';
}
