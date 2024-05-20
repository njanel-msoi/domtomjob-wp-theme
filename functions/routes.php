<?php
// add the "by region" parameter in url
// NEED DEBUG
/*
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

    return get_theme_file_path() . '/templates/jobs-by-region.php';
});
*/