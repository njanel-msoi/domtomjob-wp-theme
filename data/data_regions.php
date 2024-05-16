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
$REGIONS_MAP = array();
foreach ($REGIONS as $value) {
    // Conversion de la valeur en une clé sans accents ni espaces
    $key = strtolower(str_replace(' ', '', iconv('UTF-8', 'ASCII//TRANSLIT', $value)));
    // Création de l'objet
    $objet = array(
        "key" => $key,
        "value" => $value,
        "description" => $value
    );
    // Ajout de l'objet au tableau
    $REGIONS_MAP[] = $objet;
}

function dtj_get_regions()
{
    global $REGIONS_MAP;
    return $REGIONS_MAP;
}
