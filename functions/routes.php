<?php
// add the "by region" parameter in url


add_action('init', function () {
    // redirects from the old website (2024)
    // old job
    //add_rewrite_rule('emploi-[A-Za-z0-9]+-[0-9]+-([0-9]+)$', 'index.php?oldJobId=$matches[1]', 'top');
    add_rewrite_rule('emploi-[A-Za-z0-9]+-[0-9]+-([0-9]+)[.]html$', 'index.php?oldJobId=$matches[1]', 'top');

    add_rewrite_rule('regions/(.+)[/]?$', 'index.php?regions=$matches[1]', 'top');

    add_rewrite_rule('secteurs/(.+)[/]?/(.+)[/]?$', 'index.php?secteurId=$matches[1]&secteur=$matches[2]', 'top');
});

add_filter('query_vars', function ($query_vars) {
    // for old website redirection
    $query_vars[] = 'oldJobId';

    $query_vars[] = 'regions';
    $query_vars[] = 'secteur';
    $query_vars[] = 'secteurId';
    return $query_vars;
});

add_filter('template_include', function ($template) {
    // for old website redirection
    if (is_from_rewrite_rule('oldJobId')) {
        return get_theme_file_path() . '/redirection_migration.php';
    }

    if (is_from_rewrite_rule('regions')) {
        return get_theme_file_path() . '/templates/jobs-by-region.page.php';
    }
    if (is_from_rewrite_rule('secteurId')) {
        return get_theme_file_path() . '/templates/jobs-by-secteur.page.php';
    }
    return $template;
});
