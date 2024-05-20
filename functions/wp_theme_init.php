<?php
add_action('wp_enqueue_scripts', function () {
    global $VERSION;
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css', array(), $VERSION);
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/styles/theme.css', array(), $VERSION);
});

add_action('admin_enqueue_scripts', function () {
    global $VERSION;
    $host = parse_url(get_site_url(), PHP_URL_HOST);
    wp_enqueue_style('admin-custom', get_stylesheet_directory_uri() . '/styles/admin/admin-style.css', array(), $VERSION);
    wp_enqueue_style('admin-custom-domain', get_stylesheet_directory_uri() . '/styles/admin/admin-style-' . $host . '.css', array(), $VERSION);
});

add_action("init", function () {
    global $VERSION;
    wp_register_script('dtj-js', get_stylesheet_directory_uri() . '/js/dtj.js', array("jquery"), $VERSION);
});
