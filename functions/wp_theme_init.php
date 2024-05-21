<?php
add_action('wp_enqueue_scripts', function () {
    global $VERSION;
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css', array(), $VERSION);
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/styles/theme.css', array(), $VERSION);
    wp_enqueue_script('dtj-js', get_stylesheet_directory_uri() . '/js/dtj.js', array("jquery"), $VERSION);
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

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    if (!current_user_can('manage_options') && !is_admin()) {
        show_admin_bar(false);
    }
}
