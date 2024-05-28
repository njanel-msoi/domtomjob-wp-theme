<?php


/**
 * Hide admin bar for non admin/moderator users
 */
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    if (!current_user_can('manage_options') && !is_admin()) {
        show_admin_bar(false);
    }
}

//Login redirect on admin page
$userRedirect = 'admin.php?page=wpjb-job';
add_filter('wp_login', function ($user_login, $user) {
    global $userRedirect;

    $url = admin_url($userRedirect);
    wp_safe_redirect($url);
    exit();
}, 10, 2);

//Catch requests to the admin home page
add_filter('admin_init', function () {
    global $userRedirect;

    $currentURL = home_url(sanitize_url($_SERVER['REQUEST_URI']));
    $adminURL = get_admin_url();

    //Only redirect if we are on empty /wp-admin/
    if ($currentURL != $adminURL) {
        return;
    }

    $url = admin_url($userRedirect);
    wp_safe_redirect($url);
    exit();
}, 10);

// remove gutenberg css
add_action('wp_print_styles', function () {
    wp_dequeue_style('wp-block-library');
}, 100);

// the subscribe form is in a simple way
add_filter("wpjr_form_init_register", function ($form) {

    $fields_to_hide = array("field_name_1", "field_name_2");

    foreach ($fields_to_hide as $field_name) {

        if ($form->hasElement($field_name)) {
            $form->removeElement($field_name);
        }
    }

    // If you do not want to remove education and/or experience sections, please remove those two lines
    $form->removeGroup("education");
    $form->removeGroup("experience");

    return $form;
});
