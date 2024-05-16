<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
});
add_action('admin_enqueue_scripts', function () {
    $host = parse_url(get_site_url(), PHP_URL_HOST);
    wp_enqueue_style('admin-custom', get_stylesheet_directory_uri() . '/admin-style/admin-style.css');
    wp_enqueue_style('admin-custom-domain', get_stylesheet_directory_uri() . '/admin-style/admin-style-' . $host . '.css');
});

function preDump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function isRecruteurPage()
{
    $pagesRecruteur = array(222, 16, 8, 95, 12);
    return in_array(get_the_ID(), $pagesRecruteur);
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

// add the "by region" parameter in url

add_action('init', function () {
    add_rewrite_rule('region/(.+)[/]?$', 'index.php?region=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'region';
    return $query_vars;
});
add_filter('template_include', function ($template) {
    if (get_query_var('region') == false || get_query_var('region') == '') {
        return $template;
    }

    return get_theme_file_path() . '/jobs-by-region.php';
});
