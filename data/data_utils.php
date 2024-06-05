<?php
function str_arr_to_data_map($strArr, $useArrayKeys = false)
{
    $dataMap = array();
    foreach ($strArr as $idx => $value) {
        if (!$useArrayKeys) {
            // Conversion de la valeur en une clé sans accents ni espaces
            $key = strtolower(str_replace(' ', '', iconv('UTF-8', 'ASCII//TRANSLIT', $value)));
        } else {
            $key = $idx;
        }
        // Création de l'objet
        $objet = array(
            "key" => $key,
            "value" => $key,
            "description" => $value
        );
        // Ajout de l'objet au tableau
        $dataMap[] = $objet;
    }
    return $dataMap;
}

function object_arr_to_data_map($objArr, $titleKey)
{
    $dataMap = array();
    foreach ($objArr as $value) {
        // Création de l'objet
        $objet = array(
            "key" => $value->id,
            "value" => $value->id,
            "description" => $value->get($titleKey)
        );
        // Ajout de l'objet au tableau
        $dataMap[] = $objet;
    }
    return $dataMap;
}
