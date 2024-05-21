<?php
// add the "by region" parameter in url


add_action('init', function () {
    add_rewrite_rule('regions/(.+)[/]?$', 'index.php?regions=$matches[1]', 'top');
    add_rewrite_rule('categories/(.+)[/]?/(.+)[/]?$', 'index.php?categoryId=$matches[1]&category=$matches[2]', 'top');
});

add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'regions';
    $query_vars[] = 'category';
    $query_vars[] = 'categoryId';
    return $query_vars;
});

add_filter('template_include', function ($template) {
    if (is_from_rewrite_rule('regions')) {
        return get_theme_file_path() . '/templates/jobs-by-region.page.php';
    }
    if (is_from_rewrite_rule('categoryId')) {
        return get_theme_file_path() . '/templates/jobs-by-category.page.php';
    }
    return $template;
});
