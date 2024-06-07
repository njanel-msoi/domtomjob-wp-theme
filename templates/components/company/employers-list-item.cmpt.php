<?php

/**
 * One company template
 */

/* @var $company Wpjb_Model_Company */
?>

<div class="card-grid-1 hover-up company-item-box">
    <div class="image-box">
        <a href="<?= wpjb_link_to("company", $company) ?>" class="company-link">
            <?= company_img($company) ?>
        </a>
    </div>
    <div class="info-text mt-10">
        <h5 class="font-bold">
            <a href="<?= wpjb_link_to("company", $company) ?>">
                <?= esc_html($company->company_name) ?>
            </a>
        </h5>
        <span class="card-location"><?= get_company_location($company) ?></span>
        <div class="mt-30">
            <a class="btn btn-grey-big" href="<?= wpjb_link_to("company", $company) ?>">
                <?= $company->jobs_posted ?> offres
            </a>
        </div>
    </div>
</div>
<?php //  wpjb_date_display("M, d", $company->getUser(true)->user_registered, false) 
?>