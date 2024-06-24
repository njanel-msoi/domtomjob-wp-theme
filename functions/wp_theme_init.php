<?php

/**
 * Hide admin bar for non admin/moderator users
 */
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    // if (!current_user_can('manage_options') && !is_admin()) {
    show_admin_bar(false);
    // }
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


/* Get infos from Job or from Company if exists to fill Invoice form fields */
function initDefaultPaymentFormBillFields($form)
{
    $client     = "";
    $address    = "";
    $additional = "";
    $job_form = null;

    $company = Wpjb_Model_Company::current();
    // if job form exists, we get all from it
    $id = "wpjb_session_" . str_replace("-", "_", wpjb_transient_id());
    $transient = wpjb_session()->get($id);
    $jobId = $transient['job_id'];
    if ($jobId) {
        $job_form = new Wpjb_Form_AddJob($jobId);
        $client = $job_form->getElement('company_name')->getValue();
        $address = formVal($job_form, 'billing_address') . "\n" .
            formVal($job_form, 'billing_zipcode') . "\n" .
            formVal($job_form, 'billing_city') . "\n" .
            dtj_get_country_from_key(formVal($job_form, 'billing_country')) . "\n";
        $additional = 'Contact : ' . formVal($job_form, 'billing_contact') . "\n" .
            'Email : ' . formVal($job_form, 'billing_email') . "\n" .
            'Téléphone : ' . formVal($job_form, 'billing_phone') . "\n" .
            'SIRET : ' . formVal($job_form, 'company_siret');
        if ($company) {
            $tva = get_meta_value($company, 'billing_tax');
            if ($tva) $additional .= "\nTVA : " . $tva;
        }
    } else {
        // TODO: must be sure that we are on company subscription job if not job form
        // else we are in "direct plan buy" and we use current company
    }
    $form->getElement("wpjb_si_client")->setValue($client);
    $form->getElement("wpjb_si_address")->setValue($address);
    $form->getElement("wpjb_si_additional")->setValue($additional);
    return $form;
}
add_filter("wpjb_form_init_payment_default", "initDefaultPaymentFormBillFields", 20);
add_filter("wpjb_form_init_payment_stripe", "initDefaultPaymentFormBillFields", 20);

// configuration of tinymce
add_filter("wpjb_editor_params", function ($params) {
    $params['tinymce'] = [
        'toolbar1' => 'bold,italic,underline,strikethrough,bullist,numlist,link,unlink',
        'toolbar2' => ''
    ];
    return $params;
});

// display of tarificaton of job buy
add_filter('wpjb_form_init_job', function ($jobForm) {
    if (!$jobForm->hasElement('listing')) return;

    // change renderer to use our own
    $jobForm->getElement('listing')->setRenderer('dtj_listing_renderer');
});

add_filter('wpjb_form_save_job', function ($job) {

    // store job region to get it for tax & discount calculation
    $result = set_user_setting('currentJobRegion', get_meta_value($job, 'region'));
});

// apply different taxes based on the buyer region
add_filter('wpjb_taxer_tax_rate', function ($default, $pricing) {
    $currentCompanyRegion = get_meta_value(Wpjb_Model_Company::current(), 'region');
    if (!$currentCompanyRegion) {
        return $default;
    }
    return taxFromRegion($currentCompanyRegion);
}, 20, 2);
