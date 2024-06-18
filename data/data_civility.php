<?php

// Liste des éléments
$CIVILITIES = array(
    "Mme" => "Mme",
    "M." => "M."
);

// build a format compatible with wpjb plugin
$CIVILITIES_MAP = str_arr_to_data_map($CIVILITIES, true);

function dtj_get_civilities()
{
    global $CIVILITIES_MAP;
    return $CIVILITIES_MAP;
}
