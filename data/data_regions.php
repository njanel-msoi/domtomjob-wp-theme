<?php
define('REUNION_CODE', 4);
define('FRANCE_METROPOLE_CODE', 17);

// Liste des éléments
$REGIONS = array(
    FRANCE_METROPOLE_CODE => 'France métropolitaine',
    1 => 'Guadeloupe',
    3 => 'Guyane',
    14 => 'Île Maurice',
    16 => 'Les Comores',
    15 => 'Madagascar',
    2 => 'Martinique',
    5 => 'Mayotte',
    6 => 'Nouvelle Calédonie',
    7 => 'Polynésie Française',
    REUNION_CODE => 'Réunion',
    18 => 'Saint Barthélémy',
    10 => 'Saint-Martin',
    9 => 'Saint-Pierre et Miquelon',
    20 => 'Seychelles',
    11 => 'T.A.A.F.',
    8 => 'Wallis et Futuna',
    99 => 'Autre'
);

// build a format compatible with wpjb plugin
$REGIONS_MAP = str_arr_to_data_map($REGIONS, true);

function dtj_get_regions()
{
    global $REGIONS_MAP;
    return $REGIONS_MAP;
}

function dtj_get_region_from_key($key)
{
    global $REGIONS;
    if (!isset($REGIONS[$key])) return null;

    return $REGIONS[$key];
}
