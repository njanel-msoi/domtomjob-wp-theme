<?php

/**
 * Type de candidature pour un job
 * - formulaire en ligne (défaut)
 * - url externe
 */

$APPLY_TYPES_MAP = [
    ['key' => 'FORM', 'value' => 'FORM', "description" => "Par un formulaire en ligne"],
    ['key' => 'URL', 'value' => 'URL', "description" => "Par une url externe"]
];

function dtj_get_apply_types()
{
    global $APPLY_TYPES_MAP;
    return $APPLY_TYPES_MAP;
}
