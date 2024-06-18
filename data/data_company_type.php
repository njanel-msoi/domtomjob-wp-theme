<?php

// Liste des éléments
$COMPANY_TYPE = array(
    3 => "Entreprise privée",
    4 => "Entreprise publique ou para-publique",
    7 => "Agence d'Intérim",
    5 => "Association",
    2 => "Cabinet de recrutement métropolitain",
    1 => "Cabinet de recrutement Outre-Mer",
    9 => "Centre de formation",
    6 => "Autre"
);

// build a format compatible with wpjb plugin
$COMPANY_TYPE_MAP = str_arr_to_data_map($COMPANY_TYPE, true);

function dtj_get_company_types()
{
    global $COMPANY_TYPE_MAP;
    return $COMPANY_TYPE_MAP;
}
