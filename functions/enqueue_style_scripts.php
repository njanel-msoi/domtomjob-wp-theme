<?php

// change jquery version
// add_filter('wp_default_scripts', 'change_default_jquery');

// function change_default_jquery(&$scripts)
// {
//     if (!is_admin()) {
//         $scripts->remove('jquery');
//         // $scripts->add('jquery', false, array('jquery-core'), '1.10.2');
//     }
// }

// remove inline style of jobeleon
add_action('wp_head', function () {
    remove_action('wp_head', 'wpjobboard_theme_color_scheme');
}, 9);

// dequeue child theme scripts & styles
add_action('wp_print_styles', function () {
    $styles_to_dequeue = ['wpjobboard_theme-style'];
    foreach ($styles_to_dequeue as $style) {
        wp_dequeue_style($style);
    }
}, 100);
add_action('wp_print_scripts', function () {
    $scripts_to_dequeue = ['wpjobboard_theme-navigation', 'wpjobboard_theme_scripts', 'wpjobboard_theme-skip-link-focus-fix'];
    foreach ($scripts_to_dequeue as $script) {
        wp_dequeue_script($script);
        wp_deregister_script($script);
    }
}, 100);

add_action('wp_enqueue_scripts', function () {

    global $VERSION;
    $jobbox_theme_version = "1.0.0";

    // wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/lib/bootstrap/bootstrap.min.css', array(), $VERSION);
    wp_enqueue_style('jobbox-style', get_stylesheet_directory_uri() . '/assets/jobbox-styles/style.css', array(), $jobbox_theme_version);
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/theme-styles/style.css', array(), $VERSION);

    // wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css', array(), $VERSION);
    // wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/styles/theme.css', array(), $VERSION);

    // wp_enqueue_script('dtj-js', get_stylesheet_directory_uri() . '/assets/js/dtj.js', array("jquery"), $VERSION);


    // wp_enqueue_script('scrollup', get_stylesheet_directory_uri() . '/assets/js/plugins/scrollup.js', array('jquery', 'jquery-migrate'));
    wp_enqueue_script('jobbox', get_stylesheet_directory_uri() . '/assets/js/jobbox.js', array('jquery', 'jquery-migrate', 'scrollup'));

    // <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    // <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    // <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    // <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    // <script src="assets/js/plugins/waypoints.js"></script>
    // <script src="assets/js/plugins/wow.js"></script>
    // <script src="assets/js/plugins/magnific-popup.js"></script>
    // <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    // <script src="assets/js/plugins/select2.min.js"></script>
    // <script src="assets/js/plugins/isotope.js"></script>
    // <script src="assets/js/plugins/scrollup.js"></script>
    // <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    // <script src="assets/js/noUISlider.js"></script>
    // <script src="assets/js/slider.js"></script>
    // <script src="assets/js/main.js?v=4.1"></script>
});

/*
 * Scripts only loaded for admin panel
 */
add_action('admin_enqueue_scripts', function () {
    global $VERSION;
    wp_enqueue_style('admin-custom', get_stylesheet_directory_uri() . '/assets/theme-styles/admin/admin-style.css', array(), $VERSION);
    // admin styles per domaine
    $host = parse_url(get_site_url(), PHP_URL_HOST);
    wp_enqueue_style('admin-custom-domain', get_stylesheet_directory_uri() . '/assets/theme-styles/admin/admin-style-' . $host . '.css', array(), $VERSION);
    // super admin styles
    $user = wp_get_current_user();
    $roles = (array) $user->roles;
    if (!in_array("administrator", $roles))
        wp_enqueue_style('admin-custom-role', get_stylesheet_directory_uri() . '/assets/theme-styles/admin/admin-style-restrict-ui.css', array(), $VERSION);
});
