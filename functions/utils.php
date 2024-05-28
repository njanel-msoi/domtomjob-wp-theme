<?php


function preDump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function isRecruteurPage()
{
    $pagesRecruteur = array(222, 16, 8, 95, 12, 10, 239);
    if (in_array(get_the_ID(), $pagesRecruteur)) return true;

    // is from single cv page ? (from rewrite rule)
    if (get_post_type() == 'resume') return true;

    return false;
}

function is_company_connected()
{
    $resume = Wpjb_Model_Company::current();
    return !!$resume;
}

function get_current_resume_field($fieldName)
{
    $resume = Wpjb_Model_Resume::current();
    // if there is no current user, do not search
    if (!$resume) return NULL;

    // search in meta fields
    if (isset($resume->meta->$fieldName)) return $resume->meta->$fieldName->value();
    // search in classic fields
    if (isset($resume->getFields()[$fieldName])) return $resume->getFields()[$fieldName]['value'];

    // search in current user meta data
    $user_id = get_current_user_id();
    $value = get_user_meta($user_id, $fieldName, true);
    if ($value) return $value;

    return NULL;
}

function set_field_value_from_resume($field, $supported_fields_arr)
{
    $fieldName = $field->getName();
    if (!in_array($fieldName, $supported_fields_arr)) return;

    $value = get_current_resume_field($fieldName);
    $field->setValue($value);
}

function is_from_rewrite_rule($queryPath)
{
    return get_query_var($queryPath) == true && get_query_var($queryPath) != '';
}

function get_meta_region($object)
{
    return esc_html($object->getMeta()->region->getValues()[0]->value);
}
