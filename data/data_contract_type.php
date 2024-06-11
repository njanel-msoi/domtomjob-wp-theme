<?php
$list = new Daq_Db_Query();
$list->select();
$list->from("Wpjb_Model_Tag t");
$list->where("type = ?", Wpjb_Model_Tag::TYPE_TYPE);
$CONTRACT_TYPES = $list->execute();
$CONTRACT_TYPES_MAP = object_arr_to_data_map($CONTRACT_TYPES, 'title');

function dtj_get_contract_types()
{
    global $CATEGORIES_MAP;
    return $CATEGORIES_MAP;
}
