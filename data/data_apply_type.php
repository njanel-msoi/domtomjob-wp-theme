<?php

/**
 * Type de candidature pour un job
 * - formulaire en ligne (défaut)
 * - url externe
 */
$APPLY_TYPES = [
    "FORM" => "Par un formulaire en ligne",
    "URL" => "Par une url externe",
    "TEXT" => "Par courrier / Autre méthode"
];
$APPLY_TYPES_MAP = str_arr_to_data_map($APPLY_TYPES, true);

function dtj_get_apply_types()
{
    global $APPLY_TYPES_MAP;
    return $APPLY_TYPES_MAP;
}
