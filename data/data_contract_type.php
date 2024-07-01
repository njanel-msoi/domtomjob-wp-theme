<?php

/*old behavior with TAG 
$list = new Daq_Db_Query();
$list->select();
$list->from("Wpjb_Model_Tag t");
$list->where("type = ?", Wpjb_Model_Tag::TYPE_TYPE);
$CONTRACT_TYPES = $list->execute();
$CONTRACT_TYPES_MAP = object_arr_to_data_map($CONTRACT_TYPES, 'title');
 */

$CONTRACT = [
    1 => "CDI",
    2 => "CDD",
    3 => "Interim",
    9 => "Alternance",
    5 => "Freelance",
    4 => "Stage",
    15 => "Saisonnier",
    16 => "Contrat aidé",
    8  => "VIE",
    99 => "Autre"
];
$CONTRACT_MAP = str_arr_to_data_map($CONTRACT, true);

function dtj_get_contract_types()
{
    global $CONTRACT_MAP;
    return $CONTRACT_MAP;
}

function dtj_get_contract_from_key($key)
{
    if (!$key) return '';

    global $CONTRACT_MAP;

    foreach ($CONTRACT_MAP as $type) {
        if ($type['key'] == $key) return $type['description'];
    }
    return '';
}
