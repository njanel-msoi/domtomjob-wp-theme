<?php

// Liste des éléments
$REGIONS = array(
    "France métropolitaine",
    "Guadeloupe",
    "Guyane",
    "Île Maurice",
    "Les Comores",
    "Madagascar",
    "Martinique",
    "Mayotte",
    "Nouvelle Calédonie",
    "Outre-Mer",
    "Pays voisins",
    "Polynésie Française",
    "Réunion",
    "Saint Barthélémy",
    "Saint-Martin",
    "Saint-Pierre et Miquelon",
    "Seychelles",
    "T.A.A.F.",
    "Wallis et Futuna"
);
// build a format compatible with wpjb plugin
$REGIONS_MAP = str_arr_to_data_map($REGIONS);

function dtj_get_regions()
{
    global $REGIONS_MAP;
    return $REGIONS_MAP;
}
