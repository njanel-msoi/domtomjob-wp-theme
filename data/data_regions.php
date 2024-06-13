<?php

// Liste des éléments
$REGIONS = array(
    17 => 'France métropolitaine',
    1 => 'Guadeloupe',
    3 => 'Guyane',
    14 => 'Île Maurice',
    16 => 'Les Comores',
    15 => 'Madagascar',
    2 => 'Martinique',
    5 => 'Mayotte',
    6 => 'Nouvelle Calédonie',
    7 => 'Polynésie Française',
    4 => 'Réunion',
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
