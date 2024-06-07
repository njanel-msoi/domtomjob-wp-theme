<?php
$list = new Daq_Db_Query();
$list->select();
$list->from("Wpjb_Model_Tag t");
$list->where("type = ?", Wpjb_Model_Tag::TYPE_CATEGORY);
$CATEGORIES = $list->execute();
$CATEGORIES_MAP = object_arr_to_data_map($CATEGORIES, 'title');

function dtj_get_categories()
{
    global $CATEGORIES_MAP;
    return $CATEGORIES_MAP;
}

function dtj_get_category_from_key($key)
{
    global $CATEGORIES_MAP;
    return data_value_from_key($key, $CATEGORIES_MAP);
}
