<?php

// Liste des éléments
$REGIONS = array(
    'Francemetropolitaine' => 'France métropolitaine',
    'Guadeloupe' => 'Guadeloupe',
    'Guyane' => 'Guyane',
    'IleMaurice' => 'Île Maurice',
    'LesComores' => 'Les Comores',
    'Madagascar' => 'Madagascar',
    'Martinique' => 'Martinique',
    'Mayotte' => 'Mayotte',
    'NouvelleCaledonie' => 'Nouvelle Calédonie',
    'PolynesieFrancaise' => 'Polynésie Française',
    'Reunion' => 'Réunion',
    'SaintBarthelemy' => 'Saint Barthélémy',
    'SaintMartin' => 'Saint-Martin',
    'SaintPierreetMiquelon' => 'Saint-Pierre et Miquelon',
    'Seychelles' => 'Seychelles',
    'TAAF' => 'T.A.A.F.',
    'WallisetFutuna' => 'Wallis et Futuna'
);

// build a format compatible with wpjb plugin
$REGIONS_MAP = str_arr_to_data_map($REGIONS, true);

function dtj_get_regions()
{
    global $REGIONS_MAP;
    return $REGIONS_MAP;
}
