<?php

/**
 * [Overwrite the file in the parent template]
 * ! Careful of the parent template updates !
 * 
 * Apply for a job form
 * 
 */
?>

<div id="wpjb-form-job-apply-popup" class="popup-container <?php if ($show->apply) : ?>visible<?php endif; ?>">

    <div class="modal-content popup apply-job-form">
        <button class="btn-close close-popup" type="button" aria-label="Close"></button>

        <div class="content pl-30 pr-30 pt-50">
            <div class="text-center">
                <p class="font-sm text-brand-2">Candidature</p>
                <h2 class="mt-10 mb-5 text-brand-1 text-capitalize"><?= $job->job_title ?></h2>
                <p class="font-sm text-muted mb-30">Entrez vos informations pour les transmettre au recruteur.</p>
            </div>

            <!-- start of form -->
            <?php if (isset($form_error)) : ?>
                <div class="wpjb-flash-error" style="margin:5px">
                    <span><?php esc_html_e($form_error) ?></span>
                </div>
            <?php endif; ?>


            <?php
            // $company = Wpjb_Model_Company::current();
            // $isCompanyConnected = !!$company;

            // if ($company) {
            //     $defaultValues = [
            //         'region' => get_meta_region($company),
            //         'company_siret' => get_meta_value($company, 'company_siret'),
            //         // TODO: pourquoi l'import default ne marche pas pour category ? Pas meme format default & data categories ?
            //         'category' => get_meta_value($company, 'category'),
            //         'company_description' => $company->get('company_info'),

            //         'company_contact' => get_meta_value($company, 'company_contact_name'),
            //         // 'company_email' => get_meta_value($company, 'company_email'),
            //         'company_phone' => get_meta_value($company, 'company_phone'),
            //         'job_address' => get_meta_value($company, 'company_address'),
            //         // 'job_zip_code' => get_meta_value($company, 'company_zip_code'),
            //         'company_city' => $company->get('company_location'),
            //         // 'company_country' => get_meta_value($company, 'company_country'),

            //         'billing_contact' => get_meta_value($company, 'billing_contact_name'),
            //         'billing_email' => get_meta_value($company, 'billing_email'),
            //         'billing_phone' => get_meta_value($company, 'billing_phone'),
            //         'billing_address' => get_meta_value($company, 'billing_address'),
            //         'billing_zipcode' => get_meta_value($company, 'billing_zipcode'),
            //         'billing_city' => get_meta_value($company, 'billing_city'),
            //         'billing_country' => get_meta_value($company, 'billing_country'),
            //     ];
            // }

            $formClass = 'job-apply-form';
            $formAction = esc_attr(wpjb_link_to("job", $job, array("form" => "apply")));
            $groupsToHide = [];
            $fieldsToHide = [];
            $groupsHalfSize = [];
            $groupsWithFullSizeInput = ['group_job_sub'];
            $submitBtn = "Envoyer votre candidature";
            $noGroups = true;

            include dirname(__FILE__) .  '/../layout/form-layout.cmpt.php';
            ?>

        </div>
    </div>
    <div class="backdrop"></div>
</div>