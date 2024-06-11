<?php

/**
 * Add job form
 * 
 * Template displays add job form
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */
/* @var $form Wpjb_Form_AddJob */
/* @var $can_post boolean User has job posting priviledges */
?>

<?php if ($can_post) : ?>

    <?php $bannerTitle = '<span class="color-brand-2">Rédigez</span> votre offre';
    include 'add-job-steps-header.cmpt.php'; ?>

    <?php wpjb_flash() ?>

    <?php
    $company = Wpjb_Model_Company::current();
    $isCompanyConnected = !!$company;

    if ($company) {
        $defaultValues = [
            'region' => get_meta_region($company),
            'company_siret' => get_meta_value($company, 'company_siret'),
            'company_kbis' => get_meta_file($company, 'company_kbis'),
            'category' => get_meta_value($company, 'category'),
            'company_description' => $company->get('company_info'),

            'company_contact' => get_meta_value($company, 'company_contact_name'),
            // 'company_email' => get_meta_value($company, 'company_email'),
            'company_phone' => get_meta_value($company, 'company_phone'),
            'job_address' => get_meta_value($company, 'company_address'),
            // 'job_zip_code' => get_meta_value($company, 'company_zip_code'),
            'company_city' => $company->get('company_location'),
            // 'company_country' => get_meta_value($company, 'company_country'),

            'billing_contact' => get_meta_value($company, 'billing_contact_name'),
            'billing_email' => get_meta_value($company, 'billing_email'),
            'billing_phone' => get_meta_value($company, 'billing_phone'),
            'billing_address' => get_meta_value($company, 'billing_address'),
            'billing_zipcode' => get_meta_value($company, 'billing_zipcode'),
            'billing_city' => get_meta_value($company, 'billing_city'),
            'billing_country' => get_meta_value($company, 'billing_country'),
        ];
    }

    $formClass = 'job-add-form';
    $formAction = esc_attr($urls->preview);
    $groupsToHide = ['important_infos'];
    $fieldsToHide = [];
    $groupsHalfSize = ['company', 'billing'];
    $groupsWithFullSizeInput = ['coupon', 'captcha', 'billing', 'company'];
    $submitBtn = "Prévisualiser l'offre";

    // hide company billing & contact info if already connected
    if ($isCompanyConnected) {
        $groupsToHide[] = 'company';
        $groupsToHide[] = 'billing';
    }

    include dirname(__FILE__) .  '/../layout/form-layout.cmpt.php';
    ?>

<?php endif; ?>