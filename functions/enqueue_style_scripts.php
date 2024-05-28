<?php
add_action('wp_enqueue_scripts', function () {
    global $VERSION;
    $jobbox_theme_version = "1.0.0";

    // wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/lib/bootstrap/bootstrap.min.css', array(), $VERSION);
    wp_enqueue_style('jobbox-style', get_stylesheet_directory_uri() . '/assets/jobbox-styles/style.css', array(), $jobbox_theme_version);

    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/theme-styles/style.css', array(), $VERSION);

    // wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css', array(), $VERSION);
    // wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/styles/theme.css', array(), $VERSION);

    // wp_enqueue_script('dtj-js', get_stylesheet_directory_uri() . '/assets/js/dtj.js', array("jquery"), $VERSION);
});

add_action('admin_enqueue_scripts', function () {
    global $VERSION;
    wp_enqueue_style('admin-custom', get_stylesheet_directory_uri() . '/styles/admin/admin-style.css', array(), $VERSION);
    // admin styles per domaine
    $host = parse_url(get_site_url(), PHP_URL_HOST);
    wp_enqueue_style('admin-custom-domain', get_stylesheet_directory_uri() . '/styles/admin/admin-style-' . $host . '.css', array(), $VERSION);
    // super admin styles
    $user = wp_get_current_user();
    $roles = (array) $user->roles;
    if (!in_array("administrator", $roles))
        wp_enqueue_style('admin-custom-role', get_stylesheet_directory_uri() . '/styles/admin/admin-style-restrict-ui.css', array(), $VERSION);
});
